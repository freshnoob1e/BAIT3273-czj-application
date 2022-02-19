<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// CRUD API
// Employee
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employee/{employee}/edit', [EmployeeController::class, 'edit']);
Route::get('/employee/{employee}', [EmployeeController::class, 'show']);
Route::patch('/employee/{employee}', [EmployeeController::class, 'update']);
Route::post('/employee', [EmployeeController::class, 'store']);

// Address
Route::post('/address', [AddressController::class, 'store']);
Route::get('/address/{address}/edit', [AddressController::class, 'edit']);
Route::patch('/address/{address}', [AddressController::class, 'update']);

// Job
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/job/{job}', [JobController::class, 'show']);
Route::post('/job', [JobController::class, 'store']);
Route::patch('/job/{job}', [JobController::class, 'update']);

// Department
Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/department/{department}', [DepartmentController::class, 'show']);
Route::post('/department', [DepartmentController::class, 'store']);
Route::get('/department/{department}/edit', [DepartmentController::class, 'edit']);
Route::patch('/department/{department}', [DepartmentController::class, 'update']);

// Payment
Route::get('/payments', [PaymentController::class, 'index']);
Route::post('/payment', [PaymentController::class, 'store']);

// SEARCH API
// Employees
Route::get('/employees/{searchTerm}',[EmployeeController::class, 'searchEmployees']);

// Jobs/Dept
Route::get('/department/{department}/jobs', [DepartmentController::class, 'getJobInDepartment']);
Route::get('/departments/{searchTerm}',[DepartmentController::class, 'searchDepartments']);
Route::get('/jobs/{searchTerm}',[JobController::class, 'searchJobs']);

// Payments
Route::get('/payments/{searchTerm}',[PaymentController::class, 'searchPayments']);



