<?php

use App\Http\Controllers\GroupController;
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


Route::controller(GroupController::class)->group(function () {
    Route::get('/groups/', 'index')->name('groups.index');
    Route::get('/groups/create', 'create')->name('groups.create');
    Route::post('/groups/create', 'store')->name('groups.store');
    Route::get('/groups/{group}', 'show')->name('group.show');
    Route::get('/groups/{group}/edit', 'edit')->name('group.edit');
    Route::post('/groups/{group}/update', 'update')->name('group.update');
    Route::post('/groups/{group}/delete', 'destroy')->name('group.destroy');
});

Route::controller(SubjectController::class)->group(function () {
    Route::get('/subjects/', 'index')->name('subjects.index');
    Route::get('/subjects/create', 'create')->name('subjects.create');
    Route::post('/subjects/create', 'store')->name('subjects.store');
    Route::get('/subjects/{subject}', 'show')->name('subject.show');
    Route::get('/subjects/{subject}/edit', 'edit')->name('subject.edit');
    Route::post('/subjects/{subject}/update', 'update')->name('subject.update');
    Route::post('/subjects/{subject}/delete', 'destroy')->name('subject.destroy');
});

Route::controller(StudentController::class)->group(function () {
    Route::get('/students/', 'index')->name('students.index');
    Route::get('/students/create', 'create')->name('students.create');
    Route::post('/students/create', 'store')->name('students.store');
    Route::get('/students/{student}', 'show')->name('subject.show');
    Route::get('/students/{student}/edit', 'edit')->name('subject.edit');
    Route::post('/students/{student}/update', 'update')->name('subject.update');
    Route::post('/students/{student}/delete', 'destroy')->name('subject.destroy');
});