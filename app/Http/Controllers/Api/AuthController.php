<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

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
            return response([
                'user' => $user,
                'message' => 'User logged in successfully',
                'token' => $token
            ]);
        } else {
            return response(['message' => 'Invalid credentials'], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|regex:/^[a-zA-Z]+$/u|alpha_dash',
            'password' => 'required|string',
            'name' => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $user = User::create(array_merge(
                $request->except('password'),
                ['password' => bcrypt($request->password)]
            ));

            $theme = Theme::with(['colors', 'attributes'])->first();
            UserTheme::create([
                'users_id' => $user->id,
                'content' => json_encode($theme),
            ]);

            DB::commit();
            return response(['user' => $user, 'message' => 'User created successfully'], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['message' => 'User creation failed'], 400);
        }
    }

    public function logout(Request $request)
    {
        $accessToken = $request->bearerToken();

        PersonalAccessToken::findToken($accessToken)->delete();
        Auth::logout();
        return response(['message' => 'User logged out successfully'], 200);
    }

    // create remove user
    public function removeUser()
    {
    }
}
