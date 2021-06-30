<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth.basic')->apiResource('/user', UserController::class);

Route::middleware('auth.basic')->apiResource('/category', CategoryController::class);

Route::apiResource('/post', PostApiController::class);
