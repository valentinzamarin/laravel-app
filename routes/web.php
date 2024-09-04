<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\Post;

Route::get('/', function () {
    $posts = Post::all();
    return view('Frontpage', [ 'posts' => $posts ]);
});


// User Controller
Route::post('/register', [ UserController::class, 'register']);
Route::post('/login', [ UserController::class, 'login']);
Route::post('/logout', [ UserController::class, 'logout']);

// Post Handler
Route::get('/create-post', function () {
    return view('CreatePost');
});
Route::post('/create-post', [ PostController::class, 'create_post' ] );
Route::get( '/post/{post}', [ PostController::class, 'post_screen' ] );
Route::get('/post/{post}/edit', [ PostController::class, 'edit_post_screen']);
Route::put('/post/{post}/edit', [ PostController::class, 'save_post']);
Route::delete('/post/{id}', [ PostController::class, 'delete_post']);

Route::get('/post/tags/{tag}', [ PostController::class, 'post_tag_screen']);
