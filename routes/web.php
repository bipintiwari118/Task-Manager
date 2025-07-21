<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    //for task
    Route::get('/task/add', [TaskController::class, 'create'])->name('task.add');
    Route::post('/task/add', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/list', [TaskController::class, 'list'])->name('task.list');
    Route::get('/task/edit/{slug}', [TaskController::class, 'edit'])->name('task.edit');
    Route::get('/task/delete/{slug}', [TaskController::class, 'delete'])->name('task.delete');
    Route::get('/task/view/{slug}', [TaskController::class, 'view'])->name('task.view');

    Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('task.reorder');



});

require __DIR__.'/auth.php';
