<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ThemeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/app/{username}', [HomeController::class, "index"]);
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, "index"]);
        Route::put('/', [ProfileController::class, "update"]);
    });

    Route::apiResource('link', LinkController::class);
    Route::post('link/upload', [LinkController::class, "uploadImage"]);
    Route::delete('link/{id}/delete-image', [LinkController::class, "removeImage"]);
    Route::get('theme', [ThemeController::class, "index"]);
    Route::get('my-theme', [ThemeController::class, "myTheme"]);
    Route::put('my-theme', [ThemeController::class, "updateMyTheme"]);

    Route::post('my-theme/upload-bg', [ThemeController::class, "uploadBackground"]);
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, "login"]);
    Route::post('register', [AuthController::class, "register"]);
    Route::post('logout', [AuthController::class, "logout"]);
});
