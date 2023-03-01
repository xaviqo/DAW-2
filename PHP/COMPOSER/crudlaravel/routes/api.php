<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/discs',[TestController::class,'getAllDiscs']);
Route::get('/discs/{discId}',[TestController::class,'getDiscById']);

