<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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

Route::GET('/students/{student}', [StudentController::class, 'show'])->name('students.show')->withTrashed()->middleware('auth');

Route::GET('/students/{student}/addScore', [ScoreController::class, 'create'])->name('scores.create')->middleware('auth')->can('edit', 'student');
Route::POST('/students/{student}/saveScore', [ScoreController::class, 'store'])->name('scores.store')->middleware('auth')->can('edit', 'student');
Route::DELETE('/students/{student}/deleteScore/', [ScoreController::class, 'delete'])->name('scores.delete')->middleware('auth')->can('edit', 'student');
Route::GET('students/{student}/editScore/{subject_id}', [ScoreController::class, 'edit'])->name('scores.edit')->middleware('auth')->can('edit', 'student');
Route::PATCH('students/{student}/updateScore', [ScoreController::class, 'update'])->name('scores.update')->middleware('auth')->can('edit', 'student');

Route::GET('/groups/{group}/showJournal', [GroupController::class, 'showJournal'])->name('group_journal.index')->middleware('auth')->can('view', 'group');

Route::GET('/profile/', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
Route::POST('/profile/{student}', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::POST('/profile/{student}/updateAvatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar')->middleware('auth');

Route::POST('/students/pdf/download', [StudentController::class, 'downloadList'])->name('students.download')->middleware('auth');

Route::POST('/students/{student}/restore', [StudentController::class, 'restore'])->name('students.restore')->withTrashed()->middleware('auth');
Route::POST('/students/{student}/forceDelete', [StudentController::class, 'forceDelete'])->name('students.forceDelete')->withTrashed()->middleware('auth');
