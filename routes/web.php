<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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


Route::get('/tasks/create', function () {return view('tasks.create');})->name('tasks.create');

Route::get('/tasks/read', [TaskController::class, 'showTasks'])->name('tasks.read');

Route::get('/tasks/update', [TaskController::class, 'showTasksUpdate'])->name('tasks.update');

Route::get('/tasks/delete', [TaskController::class, 'showTasksDelete'])->name('tasks.delete');

Route::put('/tasks/update/{taskId}', [TaskController::class, 'updateTaskStatusFromView'])->name('tasks.updateFromView');

Route::delete('/tasks/delete/{task_id}', [TaskController::class, 'deleteTaskFromView'])->name('tasks.deleteFromView');

Route::post('/tasks/created', [TaskController::class, 'createTaskFromView'])->name('tasks.createFromView');






Route::get('/tasks', [TaskController::class, 'getTasks']);

