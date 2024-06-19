<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\Register\Controllers\ApiAuthRegisterController;
use App\Http\Controllers\Api\Auth\Login\Controllers\ApiAuthLoginController;
use App\Http\Controllers\Api\Auth\ApiController;

Route::apiResource('register', ApiAuthRegisterController::class);
Route::apiResource('login', ApiAuthLoginController::class);
//Route::post('register', [ApiController::class, 'register']);
//Route::post('login', [ApiController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::get('profile',[ApiController::class, 'profile']);
    Route::get('logout',[ApiController::class, 'logout']);
});
