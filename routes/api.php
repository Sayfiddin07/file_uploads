<?php

use App\Http\Controllers\Auth\JWTAuthController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("api")
    ->controller(JWTAuthController::class)
    ->group(function () {
    Route::post('login', 'login')->withoutMiddleware("api");
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('user', 'user');

});

// Route::prefix('files')
//     ->controller(FileController::class)
//     ->group(function () {
//     Route::get('/', 'index');
//     Route::post('/', 'store');
//     Route::delete('{user}/{file}', 'destroy');
// });
