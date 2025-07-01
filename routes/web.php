<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/register/customer', [RegisterController::class, 'customerRegisterForm'])->name('register.customer.form');
Route::get('/register/admin', [RegisterController::class, 'adminRegisterForm'])->name('register.admin.form');

Route::post('/register/customer', [RegisterController::class, 'customerRegister'])->name('register.customer');
Route::post('/register/admin', [RegisterController::class, 'adminRegister'])->name('register.admin');

Auth::routes(['verify' => true]);

Route::get('/admin/login', [AdminLoginController::class, 'adminLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/customer/login', [CustomerLoginController::class, 'customerLoginForm'])->name('customer.login.form');
Route::post('/customer/login', [CustomerLoginController::class, 'customerLogin'])->name('customer.login');

Route::get('/verify-email/{token}', [EmailVerificationController::class, 'emailVerify'])->name('email.verify');


require __DIR__.'/auth.php';
