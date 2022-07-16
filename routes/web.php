<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', function () {
    return view('home.contact');
})->name("home.index");

Route::get('/contact', function () {
    return view('home.contact');
})->name('home.contact');

Route::get('/posts/tag/{tag}', 'App\Http\Controllers\PostTagController@index')->name('posts.tags.index');

Route::get('/secret', 'App\Http\Controllers\HomeController@secret')
    ->name('secret')
    ->middleware('can:home.secret');

Route::resource('users', 'App\Http\Controllers\UserController')->only(['show', 'edit', 'update']);

Route::resource('posts', PostsController::class)->middleware('auth')
    ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

Route::resource('posts.comments', App\Http\Controllers\PostCommentController::class)->only(['index', 'store']);

Route::resource('users.comments', 'App\Http\Controllers\UserCommentController')->only(['store']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('mailable', function () {
    $comment = App\Models\Comment::find(1);
    return new App\Mail\CommentPostedMarkdown($comment);
});
