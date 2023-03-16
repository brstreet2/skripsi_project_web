<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
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

Route::post('/register', [AuthController::class, 'store'])->name('register.post');

Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/login', function () {
    return view('auth.login');
});

// Auth
Route::group([
    'as'        => "auth."
], function(){
    Route::post('/register', [AuthController::class, 'store'])->name('register.post');
    Route::get("/activate/{code}", [AuthController::class, "activateAccount"])->name('activate');
});

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