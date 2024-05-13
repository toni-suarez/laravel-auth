<?php

use Illuminate\Support\Facades\Route;
use App\Http\V1\Controllers\UserController;
use App\Http\V1\Controllers\UserProfileController;

Route::post('/v1/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/v1/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/v1/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/v1/profile',[UserProfileController::class, 'index'])->middleware('auth:sanctum');
Route::put('/v1/profile',[UserProfileController::class, 'update'])->middleware('auth:sanctum');
