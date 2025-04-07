<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class AuthApiController extends ApiController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('auth_token');
            return response()->json([
                'message' => 'Login Success',
                'data' => [
                    'token' => $token->plainTextToken,
                ]
            ]);
        }
        return response()->json([
            'message' => 'Login Failed'
        ], 403);
    }
}
