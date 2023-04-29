<?php

use App\Models\Link;
use App\Models\Color;
use App\Models\Theme;
use App\Models\Attribute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $theme = Theme::all();
    foreach ($theme as $key => $value) {
        Attribute::create([
            'themes_id' => $value->id,
            'button_radius' => 'rounded-full',
            'avatar_mask' => 'mask-squircle',
        ]);
    }
});
