<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\EmployeeController;


// Landing page route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes
Auth::routes(['reset' => true, 'register' => false, 'login' => false]);

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('materials', MaterialController::class);
    Route::resource('feedbacks', FeedbackController::class);
    Route::get('/materials/{material}/download', [App\Http\Controllers\MaterialController::class, 'download'])->name('materials.download');
    Route::post('/materials/{materialId}/feedback', [FeedbackController::class, 'store'])->name('feedbacks.store');
});

// Add this to your existing routes
Route::middleware(['auth'])->group(function () {
    // HR routes
    Route::middleware(['hr'])->group(function () {
        Route::get('/hr', [App\Http\Controllers\HR\DashboardController::class, 'index'])->name('hr.index');
    });

    // Employee routes
    Route::middleware(['auth', 'employee'])->group(function () {
        Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    });
});
Route::middleware(['auth', 'hr'])->group(function () {
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');  
    
    // Add these in your HR middleware group
    Route::get('/feedbacks/review', [FeedbackController::class, 'review'])->name('feedbacks.review');
    Route::post('/feedbacks/{feedback}/review', [FeedbackController::class, 'storeReview'])->name('feedbacks.storeReview');
});

// Change the root route to point to welcome view
Route::get('/', function () {
    return view('welcome');
});

// Keep other routes as they are
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/test-mail', function () {
    try {
        Mail::raw('Test email from HR Management System', function($message) {
            $message->to('sistemmanajemenhr98@gmail.com')
                   ->subject('Test Email');
        });
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Error sending email: ' . $e->getMessage();
    }
});


route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');