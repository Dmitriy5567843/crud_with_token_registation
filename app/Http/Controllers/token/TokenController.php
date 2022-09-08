<?php

namespace App\Http\Controllers\token;

use App\Http\Controllers\Controller;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;

class TokenController extends Controller
{

    public function create(TokenService $tokenService): JsonResponse
    {
        $token = $tokenService->create();

        return response()->json([
            'data' =>
                [
                    'token' => $token['token']
                ]
        ], 201);
    }

}
