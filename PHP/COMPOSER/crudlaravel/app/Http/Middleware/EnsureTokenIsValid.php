<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // Esta key esta en el archiv .env
        $key = $request->bearerToken();
        $token = env('JWT_TOKEN'); //Hay que sacarlo del request headers

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            // Me podria guardar el valor para usarlo luego pero paso
        }catch(\Exception $e) {
            return new JsonResponse(['message' => 'General error: Algo está mal'], 403); // Dependiendo del exception haremso una cosa u otar per de momento general y au
        }
        return $next($request);
    }
}
