<?php

use App\Http\Controllers\Web\GroupController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ScoreController;
use App\Http\Controllers\Web\StudentController;
use App\Http\Controllers\Web\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::resource('groups', GroupController::class)->shallow()->middleware('auth');
Route::resource('subjects', SubjectController::class)->shallow()->middleware('auth');
Route::resource('students', StudentController::class)->shallow()->middleware('auth');

Route::middleware('auth')->group(function() {

    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/{student}', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/{student}/updateAvatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    });

    Route::prefix('students')->group(function() {
        Route::POST('/pdf/download', [StudentController::class, 'downloadList'])
            ->name('students.download');
        Route::POST('/{student}/restore', [StudentController::class, 'restore'])
            ->name('students.restore')->withTrashed();
        Route::POST('/{student}/forceDelete', [StudentController::class, 'forceDelete'])
            ->name('students.forceDelete')->withTrashed();
        Route::PATCH('students/{student}/updateScore', [ScoreController::class, 'update'])
            ->name('scores.update')->can('edit', 'student');
        Route::GET('/{student}/editScore/{subject_id}', [ScoreController::class, 'edit'])
            ->name('scores.edit')->can('edit', 'student');
        Route::DELETE('/{student}/deleteScore/', [ScoreController::class, 'delete'])
            ->name('scores.delete')->can('edit', 'student');
        Route::POST('/{student}/saveScore', [ScoreController::class, 'store'])
            ->name('scores.store')->can('edit', 'student');
        Route::GET('/{student}/addScore', [ScoreController::class, 'create'])
            ->name('scores.create')->can('edit', 'student');
        Route::GET('/{student}', [StudentController::class, 'show'])
            ->name('students.show')->withTrashed();
    });
});

Route::GET('/groups/{group}/showJournal', [GroupController::class, 'showJournal'])
    ->name('group_journal.index')
    ->middleware('auth')
    ->can('view', 'group');
