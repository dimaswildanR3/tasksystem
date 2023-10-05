<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\TaskModel;
use App\Http\Controllers\CategoryController;
use App\Models\CategoryTask;

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



Route::get('/',[TaskController::class, 'awal'])->name('welcome');
Route::get('/index',[TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create',[TaskController::class, 'create'])->name('tasks.create');
Route::post('/tambah',[TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}',[TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}',[TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}',[TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/tasks/{task}/complete',[TaskController::class, 'complete'])->name('tasks.complete');
Route::get('/taskshow',[TaskController::class, 'showComplete'])->name('taskshow');

Route::get('/categories',[CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
Route::post('/tambah',[CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}',[CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}',[CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}',[CategoryController::class, 'destroy'])->name('categories.destroy');


Auth::routes();

Route::get('/home', [TaskController::class, 'index'])->name('tasks.index');
