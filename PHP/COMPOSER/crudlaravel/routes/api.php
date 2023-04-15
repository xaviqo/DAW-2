<?php

// Rutas en /api

use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiscController;

//Route::get('/discs/{discId}', [AdminController::class, 'getDiscById']);
Route::post('/auth/sign-up', [UserController::class, 'signUp']);
Route::post('/auth/log-in', [UserController::class, 'login']);
Route::get('/disc/all-discs', [DiscController::class, 'getAllDiscs']);
Route::get('/disc/{id}', [DiscController::class, 'getDiscById']);
Route::get('/disc/img/{id}', [DiscController::class, 'getDiscCover']);

// Midelware todo sobre lo que esta dentro
Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::post('/order/create',[OrderController::class,'create']);
    Route::get('/order/check/{id}',[OrderController::class,'checkOrder']);
    Route::post('/disc/edit/{id}', [DiscController::class, 'edit']);
    Route::post('/disc/delete/{id}', [DiscController::class, 'delete']);
    Route::post('/disc/create',[DiscController::class,'create']);
    Route::get('/auth/role', [RoleController::class, 'getJWTRole']);
});
