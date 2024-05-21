<?php

use Illuminate\Support\Facades\Route;
use App\Http\V1\Controllers\Users\AuthController;
use App\Http\V1\Controllers\Users\UserController;
use App\Http\V1\Controllers\Users\UserProfileController;

Route::post('/v1/user/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/v1/user/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/v1/user/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/v1/user/reset-password-token', [AuthController::class, 'passwordResetToken'])->middleware('guest');
Route::post('/v1/user/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest');

Route::get('/v1/users',[UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('/v1/user',[UserController::class, 'show'])->middleware('auth:sanctum');
Route::put('/v1/user',[UserController::class, 'update'])->middleware('auth:sanctum');

Route::get('/v1/user/profile',[UserProfileController::class, 'index'])->middleware('auth:sanctum');
Route::put('/v1/user/profile',[UserProfileController::class, 'update'])->middleware('auth:sanctum');
Route::get('/v1/user/profile/summary',[UserProfileController::class, 'summary'])->middleware('auth:sanctum');
