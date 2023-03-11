<?php

namespace App\Http\Controllers;

use App\Models\Disc;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getAllDiscs(){
        return Disc::all();
    }

    public function getDiscById($id){
        return Disc::findOrFail($id);
    }

    public function accionRandom() {

        // Esta key esta en el archiv .env
        $key = env('JWT_KEY');
        $token = env('JWT_TOKEN'); //Hay que sacarlo del request headers

        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        // Aqui ya tenemos el OK del JWT con el array de datos $decoded
        return new JsonResponse(["message" => "TODO OK", "data" => $decoded], 200);
    }

    public function login(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        // Esta key esta en el archiv .env
        $key = env('JWT_KEY');

        $userElocuent = User::where('email',$email)->first();

        $payload = [
            //'iss' => 'http://example.org', esto es para que verifique el dominoo
            //'aud' => 'http://example.com', esto lo mismo
            'iat' => time(),
            'nbf' => time(),
            'exp' => (new \DateTime())->add(new \DateInterval("P1D"))->getTimestamp(),
            'sub' => $userElocuent-getId()
        ];

        // Generamos el token
        $jwt = JWT::encode($payload, $key, 'HS256');

        // En caso de login correcto
        return new JsonResponse(['token' => $jwt]);

    }
}
