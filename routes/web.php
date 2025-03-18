<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\EmployeeController;


// Authentication Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Auth::routes(['reset' => true]);

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('materials', MaterialController::class);
    Route::resource('feedbacks', FeedbackController::class);
    Route::get('/materials/{material}/download', [App\Http\Controllers\MaterialController::class, 'download'])->name('materials.download');
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
    
    Route::get('/feedbacks/review/{feedback}', [FeedbackController::class, 'review'])->name('feedbacks.review');
    Route::post('/feedbacks/review/{feedback}', [FeedbackController::class, 'storeReview'])->name('feedbacks.storeReview');
});

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
