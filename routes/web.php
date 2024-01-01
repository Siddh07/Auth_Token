<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneRegistrationController;
use App\Http\Controllers\PhoneVerificationController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/phone', [PhoneRegistrationController::class, 'showRegistrationForm'])->name('phone.register');
Route::post('/register/phone', [PhoneRegistrationController::class, 'register'])->name('phone.register.submit');

Route::get('/verify-phone', [PhoneVerificationController::class, 'showVerificationForm'])->name('phone.verify');
Route::post('/verify-phone', [PhoneVerificationController::class, 'verify'])->name('phone.verify.submit');
//Route::post('/verify/token', [PhoneRegistrationController::class, 'verifyToken'])->name('verify.token');
Route::match(['GET', 'POST'], '/verify/token', [PhoneRegistrationController::class, 'verifyToken'])->name('verify.token');
Route::get('/regenerate', [PhoneRegistrationController::class, 'showRegenerateForm'])->name('regenerate');
Route::post('/verify/token', [PhoneVerificationController::class, 'verify'])->name('verify.token');
Route::post('regenerate/token/{phone}', [PhoneRegistrationController::class, 'regenerateToken'])
    ->name('regenerate.token');

//Route::get('/verify/{phone}', [PhoneRegistrationController::class, 'showVerifyForm'])->name('verify.form');



Route::get('verify/{phone}', [PhoneRegistrationController::class, 'showVerifyForm'])->name('verify.form');




Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');