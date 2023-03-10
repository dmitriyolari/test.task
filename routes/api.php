<?php

declare(strict_types=1);

use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('/brands', BrandController::class);
    Route::delete('/brands/{brand}/logo', [BrandController::class, 'removeLogo']);
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('/user/register', [UserController::class, 'register']);
    Route::post('/user/login', [UserController::class, 'login']);
    Route::post('/user/logout', [UserController::class, 'logout']);
});

Route::group(
    [
        'prefix' => 'v1',
        'middleware' => 'auth:sanctum'
    ],
    function () {
        Route::get('/user/info', [UserController::class, 'info']);
});
