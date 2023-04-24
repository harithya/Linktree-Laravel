<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $theme = Theme::with('colors')->get();
        return response(['message' => 'Retrieved successfully', 'theme' => $theme], 200);
    }
}
