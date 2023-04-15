<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function getJWTRole(Request $request): JsonResponse
    {
        return new JsonResponse(["decoded" => $request->attributes->get('decoded_token')], 200);
    }

}
