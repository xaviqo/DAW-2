<?php

namespace App\Http\Controllers;

use App\Models\Disc;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiscController extends Controller
{

    public function create(Request $req)
    {
        try {
            $disc = new Disc();

            if ($req->hasFile('image')) {
                $path = $req->file('image')->store('public/images');
                $disc->image = $path;
            } else {
                $disc->image = null;
            }

            $disc->fill([
                'year' => $req->input('year'),
                'name' => $req->input('name'),
                'description' => $req->input('description'),
                'genre' => $req->input('genre'),
                'price' => $req->input('price'),
            ]);
            $disc->save();

            return new JsonResponse(["message" => "Nuevo disco \"".$req->name."\" creado con éxito"], 201);
        } catch (Exception $e) {
            return new JsonResponse(["message" => "Error al crear el disco: ".$e->getMessage()], 500);
        }
    }

    public function delete($id){
        $disc = Disc::find($id);
        Disc::destroy($id);
        return new JsonResponse(["message" => "Disco \"".$disc->name."\" eliminado con éxito"], 200);
    }

    public function edit($id, Request $req){
        try {
            $disc = Disc::find($id);

            $disc->fill([
                'year' => $req->input('year'),
                'name' => $req->input('name'),
                'description' => $req->input('description'),
                'genre' => $req->input('genre'),
                'price' => $req->input('price'),
            ]);
            $disc->save();

            return new JsonResponse(["message" => "Disco \"".$req->name."\" editado con éxito"], 201);
        } catch (Exception $e) {
            return new JsonResponse(["message" => "Error al editar el disco"], 500);
        }
    }

    public function getDiscCover($id){
        $img_path = Disc::find($id)->image;
        return response()->file(Storage::path($img_path));
    }


    public function getAllDiscs(){
        return new JsonResponse(["discs" => Disc::all()], 200);
    }

    public function getDiscById($id){
        return new JsonResponse(["disc" => Disc::findOrFail($id)], 200);
    }

}
