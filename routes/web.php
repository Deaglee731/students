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
    Route::get('/groups/', 'index')->name('groups_index');
    Route::get('/groups/create', 'create')->name('groups_create');
    Route::post('/groups/create','store')->name('groups_store');
    Route::get('/groups/{group}','show')->name('group_show');
    Route::get('/groups/{group}/edit','edit')->name('group_edit');
    Route::post('/groups/{group}/update','update')->name('group_update');
    Route::post('/groups/{group}/delete','destroy')->name('group_destroy');
});