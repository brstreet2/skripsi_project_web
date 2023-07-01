<?php

use App\Http\Controllers\API\ApiAttendanceController;
use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\ApiDocumentController;
use App\Http\Controllers\API\ApiPayrollController;
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

// Api Auth
Route::post('/login', [ApiAuthController::class, "login"])->name('api.login');
Route::get('/logout', [ApiAuthController::class, "logout"])->name('api.logout');
Route::get('/profile', [ApiAuthController::class, "profile"])->name('api.profile');

// Api Attendance
Route::get('/get-attendance', [ApiAttendanceController::class, 'getAttendance'])->name('api.get.attendance');
Route::get('/get-attendance-detail', [ApiAttendanceController::class, 'getAttendanceDetail'])->name('api.get.attendance.detail');
Route::post('/post-attendance', [ApiAttendanceController::class, 'post'])->name('api.post.attendance');

// Api Payroll
Route::get('/get-payroll', [ApiPayrollController::class, 'get'])->name('api.get.payroll');

// Api Document
Route::get('/get-documents', [ApiDocumentController::class, 'get'])->name('api.get.document');
