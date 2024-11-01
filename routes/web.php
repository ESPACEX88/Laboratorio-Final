<?php

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


Route::get('/tasks/create', function () {
    return view('tasks.create');
})->name('tasks.create');

Route::get('/tasks/read', function () {
    return view('tasks.read');
})->name('tasks.read');

Route::get('/tasks/update', function () {
    return view('tasks.update');
})->name('tasks.update');

Route::get('/tasks/delete', function () {
    return view('tasks.delete');
})->name('tasks.delete');
