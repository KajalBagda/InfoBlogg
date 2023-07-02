<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AuthorMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'home'])->name('home');
// Route::get('/post', [PostController::class, 'index'])->name('post.index');

Route::post('signup', [AuthController::class, 'signup'])->name('signup');

Route::get('login', function () {
    return redirect('/');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::prefix('')->middleware(['auth', AuthorMiddleware::class])->group(
    function () {
        Route::resource('post', PostController::class);
        // Route::get('create', [PostController::class, 'create'])->name('post.create');
        // Route::post('store', [PostController::class, 'store'])->name('post.store');
        // Route::get('show/{id}', [PostController::class, 'show'])->name('post.show');
    }
);
