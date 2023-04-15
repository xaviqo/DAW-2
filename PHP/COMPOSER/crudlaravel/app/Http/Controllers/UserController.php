<?php

namespace App\Http\Controllers;

use App\Models\Disc;
use App\Models\Globals;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function signUp(Request $request)
    {
        // Obtener los valores de la solicitud
        $name = $request->input('name');
        $phone = $request->input('phone');
        $street = $request->input('street');
        $email = $request->input('email');
        $password = $request->input('password');

        // Comprobar si ya existe un usuario con el correo electrónico proporcionado
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            // Ya existe un usuario con ese correo electrónico, devolver un error
            return response()->json(['error' => 'Ya existe un usuario con ese correo electrónico'], 400);
        }

        // Crear una nueva instancia de User y asignar los valores de la solicitud
        $user = new User();
        $user->setAttribute('name',$name);
        $user->setAttribute('phone',$phone);
        $user->setAttribute('street',$street);
        $user->setAttribute('email',$email);
        $user->setAttribute('password',Hash::make($password)); // Recuerda encriptar la contraseña
        $user->setAttribute('role',Globals::$USER_ROLE);

        // No existe un usuario con ese correo electrónico, guardar el nuevo usuario
        $user->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Usuario creado con éxito'], 201);
    }

    public function login(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $admin = $request->input('admin');

        $db_user_values = DB::table('users')
            ->select('id', 'password','role')
            ->where('email', $email)
            ->first();

        if ($admin && $db_user_values->role != 'ADMIN') {
            return new JsonResponse(['message' => 'El usuario no es administrador'], 401);
        }

        if ($db_user_values == null){
            return new JsonResponse(['message' => 'Email incorrecto'], 403);
        }

        if (!Hash::check($password,$db_user_values->password)){
            return new JsonResponse(['message' => 'La contraseña no coincide'], 403);
        }

        $payload = [
            'iat' => time(),
            'nbf' => time(),
            'exp' => (new \DateTime())->add(new \DateInterval("P1D"))->getTimestamp(),
            'sub' => $db_user_values->id,
            'rol' => $db_user_values->role
        ];

        // Generamos el token
        $jwt = JWT::encode($payload, env('JWT_KEY'), 'HS256');

        // En caso de login correcto
        return new JsonResponse([
            'token' => $jwt,
            'mail' => $email,
            'role' => $db_user_values->role
        ]);

    }

    public function accionRandom() {

        // Esta key esta en el archiv .env
        $key = env('JWT_KEY');
        $token = env('JWT_TOKEN'); //Hay que sacarlo del request headers

        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        // Aqui ya tenemos el OK del JWT con el array de datos $decoded
        return new JsonResponse(["message" => "TODO OK", "data" => $decoded], 200);
    }
}
