<?php

// Rutas en /api

use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


// Mierdas tuyas
//Route::get('/discs', [TestController::class, 'getAllDiscs']);
//Route::get('/discs/{discId}', [TestController::class, 'getDiscById']);


Route::post('/login', [TestController::class, 'login']);

// Midelware todo sobre lo que esta dentro
Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::get('/accion-random', [TestController::class, 'accionRandom']);
});
