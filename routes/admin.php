<?php

use App\Enum\CompanyStatus;
use App\Livewire\Admin\Companies;
use App\Livewire\Admin\CompaniesList;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\LoginForm;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', LoginForm::class)->name('login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');

        // Companies Management
        Route::prefix('companies')->name('companies.')->group(function () {
            Route::get('/', Companies::class)->name('index');
            Route::get('/pending', CompaniesList::class)->defaults('status', CompanyStatus::PENDING->value)->name('pending');
        });

        // Orders Management
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', Dashboard::class)->name('index');
        });

        // Reports Management
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', Dashboard::class)->name('index');
        });

        // Customers Management
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', Dashboard::class)->name('index');
        });

        //Financial Management
        Route::prefix('financials')->name('financials.')->group(function () {
            Route::get('/', Dashboard::class)->name('index');
        });

        // Analytics Management
        Route::prefix('analytics')->name('analytics.')->group(function () {
            Route::get('/', Dashboard::class)->name('index');
        });

        // Settings Management
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', Dashboard::class)->name('index');
        });
    });
});
