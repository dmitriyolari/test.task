<?php

declare(strict_types=1);

use App\Http\Controllers\api\v1\BrandController;
use App\Http\Controllers\api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/brand'], function () {
    Route::apiResource('/', BrandController::class);
    Route::delete('/{brand}/logo', [BrandController::class, 'removeLogo']);
});

Route::group(['prefix' => 'v1/user'], function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::group(
    [
        'prefix' => 'v1',
        'middleware' => 'auth:sanctum'
    ],
    function () {
        Route::get('/user/info', [UserController::class, 'info']);
});
