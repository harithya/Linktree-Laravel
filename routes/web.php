<?php

use App\Models\Link;
use App\Models\Color;
use App\Models\Theme;
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
    $data = array(
        'name' => 'autumn',
        'image' => 'https://res.cloudinary.com/cv-abdi-creative/image/upload/v1680871409/next-tree/photo_2023-04-07_19-42-58_yycsll.jpg',
        'colors' =>
        array(
            'background' => '#f1f1f1',
            'button' => '#8c0327',
            'text_button' => '#ffb6c9',
            'title' => '#303030',
        ),
    );

    $theme = Theme::create([
        'name' => $data['name'],
        'image' => $data['image'],
    ]);

    Color::create([
        'background' => $data['colors']['background'],
        'button' => $data['colors']['button'],
        'text_button' => $data['colors']['text_button'],
        'title' => $data['colors']['title'],
        'themes_id' => $theme->id,
    ]);
});
