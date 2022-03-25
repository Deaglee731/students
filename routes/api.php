<?php

use App\Http\Controllers\api\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::GET('login', [AuthController::class, 'login'])->name('api.login');

    Route::POST('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::POST('reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset.password');
});
