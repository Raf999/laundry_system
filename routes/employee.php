<?php

use App\Http\Controllers\Employee\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Employee\Auth\NewPasswordController;
use App\Http\Controllers\Employee\Auth\PasswordController;
use App\Http\Controllers\Employee\Auth\PasswordResetLinkController;
use App\Livewire\Employees\Customers;
use App\Livewire\Employees\Dashboard;
use App\Livewire\Employees\LoginForm;
use App\Livewire\Employees\Orders;
use App\Livewire\Employees\Reports;
use App\Livewire\Employees\Settings;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')->name('employee.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', LoginForm::class)->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

    Route::middleware('auth:employees')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/orders', Orders::class)->name('orders');
        Route::get('/customers', Customers::class)->name('customers');
        Route::get('/reports', Reports::class)->name('reports');
        Route::get('/settings', Settings::class)->name('settings');

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});
