<?php

namespace App\Http\Controllers;

use App\Models\Disc;

class TestController extends Controller
{
    public function getAllDiscs(){
        return Disc::all();
    }

    public function getDiscById($id){
        return Disc::findOrFail($id);
    }
}
