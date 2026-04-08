<?php

use Illuminate\Support\Facades\Route; 

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);
Route::get('/dashboard', [EmployeeController::class, 'dashboard']);