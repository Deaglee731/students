<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\ScoreController;
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

    Route::GET('/students/{student}/addScore', [ScoreController::class, 'create'])
        ->name('scores.create')
        ->middleware('auth')
        ->can('edit', 'student');

    Route::POST('/students/{student}/saveScore', [ScoreController::class, 'store'])
        ->name('scores.store')
        ->middleware('auth')
        ->can('edit', 'student');

    Route::DELETE('/students/{student}/deleteScore/', [ScoreController::class, 'delete'])
        ->name('scores.delete')
        ->middleware('auth')
        ->can('edit', 'student');

    Route::GET('students/{student}/editScore/{subject_id}', [ScoreController::class, 'edit'])
        ->name('scores.edit')
        ->middleware('auth')
        ->can('edit', 'student');

    Route::PATCH('students/{student}/updateScore', [ScoreController::class, 'update'])
        ->name('scores.update')
        ->middleware('auth')
        ->can('edit', 'student');

    Route::POST('/students/{student}/restore', [StudentController::class, 'restore'])
        ->name('students.restore')
        ->withTrashed()
        ->middleware('auth');

    Route::POST('/students/{student}/forceDelete', [StudentController::class, 'forceDelete'])
        ->name('students.forceDelete')
        ->withTrashed()
        ->middleware('auth');
});
