<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use GuzzleHttp\Middleware;
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

require __DIR__.'/auth.php';

Route::resource('groups', GroupController::class)->shallow()->middleware('auth');
Route::resource('subjects', SubjectController::class)->shallow()->middleware('auth');
Route::resource('students', StudentController::class)->shallow()->middleware('auth');

Route::GET('/students/{student}/addScore', [ScoreController::class, 'create'])->name('scores.create')->middleware('auth');
Route::POST('/students/{student}/saveScore', [ScoreController::class, 'store'])->name('scores.store')->middleware('auth');
Route::DELETE('/students/{student}/deleteScore/', [ScoreController::class, 'delete'])->name('scores.delete')->middleware('auth');
Route::GET('students/{student}/editScore/{subject_id}', [ScoreController::class, 'edit'])->name('scores.edit')->middleware('auth');
Route::PATCH('students/{student}/updateScore', [ScoreController::class, 'update'])->name('scores.update')->middleware('auth');

Route::GET('/groups/{group}/showJournal' , [GroupController::class, 'showJournal'])->name('group_journal.index')->middleware('auth');

Route::GET('/profile/',[ProfileController::class, 'index'])-> name('profile.index')->middleware('auth');
Route::POST('/profile/{student}',[ProfileController::class,'update'])->name('profile.update')->middleware('auth');
