<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\Subjects;
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

Route::resource('groups', GroupController::class)->shallow();
Route::resource('subjects', SubjectController::class)->shallow();
Route::resource('students', StudentController::class)->shallow();


Route::GET('/students/{student}/addScore', [ScoreController::class, 'create'])->name('scores.create');
Route::POST('/students/{student}/saveScore', [ScoreController::class, 'store'])->name('scores.store');
Route::DELETE('/students/{student}/deleteScore/', [ScoreController::class, 'delete'])->name('scores.delete');
Route::GET('students/{student}/editScore/{subject_id}', [ScoreController::class, 'edit'])->name('scores.edit');
Route::PATCH('students/{student}/updateScore', [ScoreController::class, 'update'])->name('scores.update');
