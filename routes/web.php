<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
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

Route::prefix('/Task-Management')->group(function(){
    Route::view('/Dashboard','TaskManagement.dashboard')->name('Task-Management.dashboard');
    Route::resource('employees',EmployeeController::class);
    Route::resource('attendances',AttendanceController::class);
    Route::resource('projects',ProjectController::class);
    Route::resource('tasks',TaskController::class);

    Route::get('projects/{project}/tasks',[ProjectController::class,'showTasks'])->name('projectTasks.show');
    Route::put('projects/{project}/tasks',[ProjectController::class,'updateTasks']);
});
