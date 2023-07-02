<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmployeesController;
use App\Http\Controllers\Dashboard\AttendanceController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DocumentController;
use App\Http\Controllers\Dashboard\PayrollController;
use App\Http\Controllers\Dashboard\PricingController;
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

Route::get('', [AuthController::class, 'home'])->name('home');

// Auth
Route::group([
    'as'        => "auth."
], function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get("/activate/{code}", [AuthController::class, "activateAccount"])->name('activate');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Dashboard
Route::group([
    'as'            => "dashboard.",
    'prefix'        => "dashboard",
    'middleware'    => ["auth.middleware"],
], function () {
    Route::get('', [DashboardController::class, 'index'])->name('index');
});

// Pricing
Route::group([
    'as'        => "pricing.",
    'prefix'    => "pricing",
    'middleware'    => ["auth.middleware"],
], function () {
    Route::get('', [PricingController::class, 'index'])->name('index');
});

// Company
Route::group([
    'as'        => "company.",
    'prefix'    => "company",
    'middleware'    => ["auth.middleware"],
], function () {
    Route::get('', [CompanyController::class, 'index'])->name('index');
    Route::get('/create', [CompanyController::class, 'create'])->name('create');
    Route::post('/store', [CompanyController::class, 'store'])->name('store');
    Route::get('/ajax/provinces', [CompanyController::class, 'getProvinces'])->name('ajax.provinces');
    Route::post('/ajax/regencies', [CompanyController::class, 'getRegencies'])->name('ajax.regencies');
    Route::get('/ajax/industries', [CompanyController::class, 'getIndustries'])->name('ajax.industries');
    Route::get('/ajax/company/size', [CompanyController::class, 'getCompanySizes'])->name('ajax.sizes');
});


// Employee
Route::group([
    'as'        => "employee.",
    'prefix'    => "employee",
    'middleware'    => ["auth.middleware"],
], function () {
    Route::get('', [EmployeesController::class, 'index'])->name('index');
    Route::post('/store', [EmployeesController::class, 'store'])->name('store');
    Route::get('/ajax/datatables', [EmployeesController::class, 'datatables'])->name('ajax.datatables');
});

// Payroll
Route::group([
    'as'            => "payroll.",
    'prefix'        => "payroll",
    'middleware'    => ["auth.middleware"],
], function () {
    Route::get('', [PayrollController::class, 'index'])->name('index');
    Route::post('/store', [PayrollController::class, 'store'])->name('store');
    Route::get('/ajax/datatables', [PayrollController::class, 'datatables'])->name('ajax.datatables');
});

// Time Management
Route::group([
    'as'            => "attendance.",
    'prefix'        => "attendance",
    'middleware'    => ["auth.middleware"],
], function () {
    Route::get('', [AttendanceController::class, 'index'])->name('index');
    Route::get('/ajax/datatables', [AttendanceController::class, 'datatables'])->name('ajax.datatables');
    Route::get('presence/{id}', [AttendanceController::class, 'presence'])->name('presence');
    Route::post('/presence/datatables', [AttendanceController::class, 'presenceDatatables'])->name('ajax.presence.datatables');
    Route::post('/presence/approve', [AttendanceController::class, 'attendanceApprove'])->name('approve');
    Route::post('/presence/reject', [AttendanceController::class, 'attendanceReject'])->name('reject');
    Route::post('/presence/reason', [AttendanceController::class, 'attendanceReason'])->name('reason');
});

// Document
Route::group([
    'as'        => "document.",
    'prefix'    => "document",
    'middleware'    => ["auth.middleware"],
], function () {
    Route::get('', [DocumentController::class, 'index'])->name('index');
    Route::post('', [DocumentController::class, 'store'])->name('store');
    Route::get('create', [DocumentController::class, 'create'])->name('create');
    Route::get('ajax/datatables', [DocumentController::class, 'datatables'])->name('ajax.datatables');
    Route::get('/edit/{slug}', [DocumentController::class, 'edit'])->name('edit');
    Route::post('destroy/bulk', [DocumentController::class, 'destroyBulk'])->name('destroy.bulk');
    Route::get('/show/{slug}', [DocumentController::class, 'show'])->name('show');
    Route::delete('delete/{id}', [DocumentController::class, 'destroy'])->name('destroy');
});

// Announcement

//Error
Route::get('/404', function () {
    return view('errors.error');
});

//view attendance
Route::get('/attendance/view', function () {
    return view('backend.attendance.view');
});

//timeoff attendance
Route::get('/attendance/timeoff', function () {
    return view('backend.attendance.timeoff');
});

//edit company
Route::get('/company/edit', function () {
    return view('backend.company.editcompany');
});

//edit tax company
Route::get('/company/tax', function () {
    return view('backend.company.taxcompany');
});

//generate report
Route::get('/report', function () {
    return view('backend.report.index');
});

//generate report
Route::get('/home', function () {
    return view('auth.dashboard');
});

//announcement
Route::get('/announcement', function () {
    return view('backend.announcement.index');
});
