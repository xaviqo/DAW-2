<?php

// Rutas en /api

use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

// Mierdas tuyas
//Route::get('/discs', [TestController::class, 'getAllDiscs']);
//Route::get('/discs/{discId}', [TestController::class, 'getDiscById']);

// USER ROUTES

Route::post('/sign-up', [UserController::class, 'signUp']);
Route::post('/log-in', [UserController::class, 'login']);

// Midelware todo sobre lo que esta dentro
Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::get('/accion-random', [TestController::class, 'accionRandom']);
});
