<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $auth = Auth::attempt($request->all());
        if ($auth) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response(['user' => $user, 'token' => $token]);
        } else {
            return response(['message' => 'Invalid credentials'], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|string',
            'name' => 'required|string'
        ]);

        $user = User::create(array_merge(
            $request->except('password'),
            ['password' => bcrypt($request->password)]
        ));

        if ($user) {
            return response(['user' => $user, 'message' => 'User created successfully'], 201);
        } else {
            return response(['message' => 'Invalid credentials'], 401);
        }
    }
}
