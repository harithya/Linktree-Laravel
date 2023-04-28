<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\UserTheme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $theme = Theme::with('colors')->get();
        return response(['message' => 'Retrieved successfully', 'theme' => $theme], 200);
    }

    public function myTheme()
    {
        $theme = UserTheme::where('users_id', getUser()->id)
            ->first();
        return response(['message' => 'Retrieved successfully', 'theme' => $theme], 200);
    }

    public function updateMyTheme(Request $request)
    {
        if ($request->has('content')) {
            UserTheme::where('users_id', getUser()->id)->update([
                'content' => $request->content
            ]);
        }

        return response(['message' => 'Updated successfully'], 200);
    }

    public function uploadBackground(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $theme = UserTheme::where('users_id', getUser()->id)
            ->first();

        if ($theme->bg_image) {
            unlink(public_path('images/' . $theme->bg_image));
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        UserTheme::where('users_id', getUser()->id)->update([
            'bg_image' => $imageName
        ]);

        return response(['message' => 'Updated successfully', 'image' => url('images/' . $imageName)], 200);
    }
}
