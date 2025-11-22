<?php

use App\Enum\OrderStatus;
use App\Http\Controllers\Staff\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Staff\Auth\NewPasswordController;
use App\Http\Controllers\Staff\Auth\PasswordController;
use App\Http\Controllers\Staff\Auth\PasswordResetLinkController;
use App\Livewire\Staff\Customers;
use App\Livewire\Staff\Dashboard;
use App\Livewire\Staff\LoginForm;
use App\Livewire\Staff\Orders;
use App\Livewire\Staff\Reports;
use App\Livewire\Staff\Settings;
use Illuminate\Support\Facades\Route;

Route::prefix('staff')->name('staff.')->group(function () {
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

    Route::middleware('auth:staff')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::prefix('orders')->as('orders.')->group(function () {
            Route::get('/', Orders::class)->name('orders');
            Route::get('/ready_for_pickup', Orders::class)->defaults('status', OrderStatus::READY_FOR_PICKUP->value)->name('ready-for-pickup');
        });
        Route::get('/orders', Orders::class)->name('orders');
        Route::get('/customers', Customers::class)->name('customers');
        Route::get('/reports', Reports::class)->name('reports');
        Route::get('/settings', Settings::class)->name('settings');

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});
