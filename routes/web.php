<?php

use App\Http\Controllers\GroupController;
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
    Route::post('/groups/create','store')->name('groups.store');
    Route::get('/groups/{group}','show')->name('group.show');
    Route::get('/groups/{group}/edit','edit')->name('group.edit');
    Route::post('/groups/{group}/update','update')->name('group.update');
    Route::post('/groups/{group}/delete','destroy')->name('group.destroy');
});