<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RegisterController;

use App\Http\Controllers\CandidateController;

use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/jenjang/{slug}', [PageController::class, 'jenjang'])->name('jenjang.show');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [CandidateController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/biodata', [CandidateController::class, 'biodata'])->name('student.biodata');
    Route::put('/student/biodata', [CandidateController::class, 'updateBiodata'])->name('student.biodata.update');
    Route::get('/student/payment', [CandidateController::class, 'payment'])->name('student.payment');
    Route::post('/student/payment', [CandidateController::class, 'uploadPayment'])->name('student.payment.upload');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/verify/{id}', [AdminController::class, 'verify'])->name('admin.verify');
    Route::put('/admin/verify/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
});
