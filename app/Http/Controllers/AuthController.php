<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'data' => [
                    'token' => $request->user()->createToken($request->email)->plainTextToken
                ]
            ]);
        }

        return response()->json([
            'errors' => [
                [
                    'status' => 401,
                    'description' => "Invalid username or password"
                ]
            ]
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response('', 204);
    }
}
