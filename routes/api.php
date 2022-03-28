<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
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

Route::POST('login', [AuthController::class, 'login'])->name('api.login');

Route::POST('reset-password', [AuthController::class, 'resetPassword'])->name('api.reset.password');

Route::middleware('auth:api')->group(function () {
    Route::POST('logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::resource('groups', GroupController::class)->shallow()->middleware('auth:api');
    Route::resource('subjects', SubjectController::class)->shallow()->middleware('auth:api');
    Route::resource('students', StudentController::class)->shallow()->middleware('auth:api');

    Route::GET('/students/{student}', [StudentController::class, 'show'])
        ->name('students.show')
        ->withTrashed()
        ->middleware('auth:api');

    Route::POST('/students/pdf/download', [StudentController::class, 'downloadList'])
        ->name('students.download')
        ->middleware('auth');
});
