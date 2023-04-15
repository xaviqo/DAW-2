<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $decoded = JWT::decode($request->bearerToken(), new Key(env('JWT_KEY'), 'HS256'));
            $request->attributes->add(['decoded_token' => $decoded]); // Agregar el valor decodificado al objeto Request
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'General error: Algo está mal'], 403);
        }

        return $next($request);
    }
}
