<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return getUser();
        $user = User::find(auth()->user()->id);
        return response(['user' => $user, "message" => "User profile fetched successfully"]);
    }
}
