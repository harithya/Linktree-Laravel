<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\User;
use App\Models\UserTheme;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($username)
    {
        $theme =  UserTheme::leftJoin('users', 'users.id', '=', 'user_themes.users_id')
            ->where('users.username', $username)
            ->first();

        $user = User::where('username', $username)->first();
        $link = Link::where('users_id', $user->id)->where('is_active', 1)->get();

        return response([
            'message' => 'Retrieved successfully',
            'result' => [
                'theme' => $theme->content,
                'user' => $user,
                'link' => $link
            ]
        ]);
    }
}
