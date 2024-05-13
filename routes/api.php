<?php

use Illuminate\Support\Facades\Route;
use App\Http\V1\Controllers\UserController;

Route::post('/v1/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/v1/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/v1/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/v1/profile',[UserController::class, 'profile'])->middleware('auth:sanctum');
Route::put('/v1/profile',[UserController::class, 'update'])->middleware('auth:sanctum');
