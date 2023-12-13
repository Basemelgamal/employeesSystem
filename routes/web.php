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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Your authenticated routes here
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/departments', App\Http\Controllers\DepartmentController::class);
    Route::resource('/employees', App\Http\Controllers\EmployeeController::class);
    Route::resource('/{employee}/tasks', App\Http\Controllers\TaskController::class)->names([
        'index'     => 'tasks.index',
        'create'    => 'tasks.create',
        'store'     => 'tasks.store',
        'edit'      => 'tasks.edit',
        'update'    => 'tasks.update',
        'destroy'   => 'tasks.destroy',
    ]);

    Route::put('/tasks/{task}/update-is-finished', [App\Http\Controllers\TaskController::class, 'update'])
    ->middleware('can:updateIsFinished,task');

});

