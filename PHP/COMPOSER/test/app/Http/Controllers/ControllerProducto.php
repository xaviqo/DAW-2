<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ControllerProducto extends Controller
{
    public function getAllProductos(){
        $allProductos = Producto::all();
        return view('welcome', ['productos' => $allProductos]);
    }
}
