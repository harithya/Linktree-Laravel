<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(getUser()->id);
        return response(['user' => $user, "message" => "User profile fetched successfully"]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        $profile = User::find(getUser()->id);
        $file = $request->file('image');

        if ($file) {
            // remove image old
            if ($profile->image) {
                $removeProfile = explode('/', $profile->image);
                $image_path = public_path('images/avatar/' . end($removeProfile));
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/avatar/'), $file_name);
            $profile->image = $file_name;
        }
        if ($request->has('name')) {
            $profile->name = $request->name;
        }

        if ($request->has('remove_image')) {
            if ($profile->image) {
                $removeProfile = explode('/', $profile->image);
                $image_path = public_path('images/' . end($removeProfile));
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $profile->image = null;
        }

        if ($request->has('bio')) {
            $profile->bio = $request->bio;
        }

        $profile->update();

        return response(["message" => "User profile updated successfully"]);
    }
}
