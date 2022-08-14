<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('/Task-Management')
->middleware('auth:employee')
->group(function(){
    Route::view('/Dashboard','TaskManagement.dashboard')->name('Task-Management.dashboard');
    Route::resource('employees',EmployeeController::class);
    Route::resource('attendances',AttendanceController::class);
    Route::resource('projects',ProjectController::class);
    Route::resource('tasks',TaskController::class);

    Route::get('projects/{project}/tasks',[ProjectController::class,'showTasks'])->name('projectTasks.show');
    Route::put('projects/{project}/tasks',[ProjectController::class,'updateTasks']);

    Route::get('edit-password',[AuthController::class,'editPassword'])->name('Task-Management.edit-password');
    Route::put('edit-password',[AuthController::class,'updatePassword']);

    Route::get('logout',[AuthController::class,'logout'])->name('logout');

    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);

    Route::get('roles/{role}/permission',[RoleController::class,'editRolePermission'])->name('rolePermission.edit');
    Route::put('roles/{role}/permission',[RoleController::class,'updateRolePermission']);
});

Route::prefix('/Task-Management')->middleware('guest:employee')->group(function(){
    Route::get('employee/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('login',[AuthController::class,'login']);

});