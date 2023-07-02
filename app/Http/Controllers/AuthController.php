<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check())
            return redirect('/');

        return view('index', compact('email'));
    }

    public function login(Request $request)
    {
        $cred = $request->only('email', 'password');
        if (Auth::attempt($cred)) {
            return redirect('/');
        }

        return redirect('/')->withErrors('Email or password not matched');
    }

    public function signup(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|unique:users',
                'fname' => 'required',
                'lname' => 'required',
                'password' => 'required|confirmed',
            ]
        );

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/')->with('success', 'User registered successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
