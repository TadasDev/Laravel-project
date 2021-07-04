<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsStarsController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegistrationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// auth routes
Route::get('/login', [LoginController::class, 'index'])
    ->name('authentication.login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'index'])
    ->name('authentication.logout');

Route::get('/register', [RegistrationController::class, 'index'])
    ->name('authentication.registration');
Route::post('/register', [RegistrationController::class, 'save']);
//
Route::get('/profile/edit',[UserController::class,'view'])
    ->name('profile.edit');
Route::post('/profile/edit',[UserController::class,'edit']);


// content routes
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.list');
Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.delete');

Route::post('/posts/{post}/stars', [PostsStarsController::class, 'store'])
    ->name('posts.stars');
Route::delete('/posts/{post}/stars', [PostsStarsController::class, 'destroy'])
    ->name('posts.stars');


