<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmployeesController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DocumentController;
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


// Auth
Route::group([
    'as'        => "auth."
], function(){
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get("/activate/{code}", [AuthController::class, "activateAccount"])->name('activate');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Dashboard
Route::group([
    'as'        => "dashboard.",
    'prefix'    => "dashboard"
], function() {
    Route::get('', [DashboardController::class, 'index'])->name('index');
});

// Pricing
Route::group([
    'as'        => "pricing.",
    'prefix'    => "pricing"
], function() {
    Route::get('', [PricingController::class, 'index'])->name('index');
});

// Company
Route::group([
    'as'        => "company.",
    'prefix'    => "company"
], function() {
    Route::get('', [CompanyController::class, 'index'])->name('index');
});

Route::group([
    'as'        => "employee.",
    'prefix'    => "employee"
], function () {
    Route::get('', [EmployeesController::class, 'index'])->name('index');
});

// Document
Route::group([
    'as'        => "document.",
    'prefix'    => "document"
], function() {
    Route::get('', [DocumentController::class, 'index'])->name('index');
    Route::post('', [DocumentController::class, 'store'])->name('store');
    Route::get('create', [DocumentController::class, 'create'])->name('create');
    Route::get('ajax/datatables', [DocumentController::class, 'datatables'])->name('ajax.datatables');
    Route::get('/edit/{slug}', [DocumentController::class, 'edit'])->name('edit');
    Route::post('destroy/bulk', [DocumentController::class, 'destroyBulk'])->name('destroy.bulk');
    Route::get('/show/{slug}', [DocumentController::class, 'show'])->name('show');
    Route::delete('delete/{id}', [DocumentController::class, 'destroy'])->name('destroy');
});

//Error
Route::get('/404', function () {
    return view('errors.error');
});

