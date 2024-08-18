<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $loginUserData = $request->validate([
            'username' => 'sometimes|required|string',
            'email' => 'sometimes|required|string|email',
            'password' => 'required'
        ]);
        $user = null;
        if (isset($loginUserData['email'])) {
            $user = User::where('email', $loginUserData['email'])->first();
        } else if (isset($loginUserData['username'])) {
            $user = User::where('username', $loginUserData['username'])->first();
        }

        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        $token = $user->createToken($user->username . '-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function delete(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json('Logged out successfully');
    }
}
