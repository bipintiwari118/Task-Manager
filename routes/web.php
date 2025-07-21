<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
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

    // Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    //for task
    Route::get('/task/add', [TaskController::class, 'create'])->name('task.add');
    Route::post('/task/add', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/list', [TaskController::class, 'list'])->name('task.list');
    Route::get('/task/edit/{slug}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/task/edit/{slug}', [TaskController::class, 'update'])->name('task.update');
    Route::get('/task/delete/{slug}', [TaskController::class, 'delete'])->name('task.delete');
    Route::get('/task/view/{slug}', [TaskController::class, 'view'])->name('task.view');

    Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('task.reorder')->middleware('role:Admin');



Route::group(['middleware' => ['role:Admin']], function () {
    //route for permission
Route::get('/permission/create',[PermissionController::class, 'create'])->name('permission.create');
Route::post('/permission/create',[PermissionController::class, 'store'])->name('permission.store');
Route::get('/permission/list',[PermissionController::class, 'list'])->name('permission.list');
Route::get('/permission/edit/{id}',[PermissionController::class, 'edit'])->name('permission.edit');
Route::post('/permission/edit/{id}',[PermissionController::class, 'update'])->name('permission.update');
Route::get('/permission/delete/{id}',[PermissionController::class, 'delete'])->name('permission.delete');



//route for role
Route::get('/role/create',[RoleController::class, 'create'])->name('role.create');
Route::post('/role/create',[RoleController::class, 'store'])->name('role.store');
Route::get('/role/list',[RoleController::class, 'list'])->name('role.list');
Route::get('/role/edit/{id}',[RoleController::class, 'edit'])->name('role.edit');
Route::post('/role/edit/{id}',[RoleController::class, 'update'])->name('role.update');
Route::get('/role/delete/{id}',[RoleController::class, 'delete'])->name('role.delete');
//role to permission
Route::get('/role/permission/{id}',[RoleController::class, 'addPermission'])->name('add.role.permission');
Route::post('/role/permission/{id}',[RoleController::class, 'giveRolePermission'])->name('give.role.permission');



//route for users
  Route::get('users', [UserController::class, 'list'])->name('users.list');
  Route::get('users/create', [UserController::class, 'create'])->name('users.create');
  Route::post('users/create', [UserController::class, 'store'])->name('users.store');
  Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
  Route::post('users/edit/{id}', [UserController::class, 'update'])->name('users.update');
  Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
  Route::get('users/show/{id}', [UserController::class, 'show'])->name('users.show');

});

});

require __DIR__.'/auth.php';
