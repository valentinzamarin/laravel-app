<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('frontpage');
});


// User Controller
Route::post('/register', [ UserController::class, 'register']);
