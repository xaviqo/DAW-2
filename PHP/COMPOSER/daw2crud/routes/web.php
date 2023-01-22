<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

<<<<<<< HEAD:PHP/COMPOSER/daw2crud/routes/web.php
Route::get('/', function () {
    return view('welcome');
});

Route::resource('book',BookController::class);

// Route::get('/books/create', [BookController::class, 'create']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
=======
Route::get('/', [\App\Http\Controllers\ControllerProducto::class,'getAllProductos']);
>>>>>>> 14fdf4c50d0bdbe88c219c265ecdb8cc5f5b3e6f:PHP/COMPOSER/test/routes/web.php
