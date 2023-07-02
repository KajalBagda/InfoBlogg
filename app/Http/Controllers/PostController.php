<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $posts = Post::take(3)->get();
        return view('blog.index', compact('posts'));
    }

    public function index()
    {
        $user_posts = Auth::user()->getPosts()->get();
        $public = Post::where('visibility', 3)->where('author', '!=', Auth::user()->id)->get();
        return view('blog.blogs', compact('public', 'user_posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->author = Auth::user()->id;
        $post->title = $request->title;
        $post->visibility = $request->visibility;
        $post->desc = $request->desc;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('post.show', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (Auth::user()->id != $post->author && $post->visibility == 2)
            return abort(404);
        return view('blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id != $post->author)
            return abort(404);
        return view('blog.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id != $post->author)
            return abort(404);
        $post->title = $request->title;
        $post->visibility = $request->visibility;
        $post->desc = $request->desc;
        $post->content = $request->content;
        $post->save();
        // return redirect()->route('post.edit', $post->id);
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id != $post->author)
            return abort(404);
        $post->delete();
        return redirect()->back();
    }
}
