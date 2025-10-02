<?php

use App\Livewire\Admin\Companies;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\LoginForm;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', LoginForm::class)->name('login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('companies', Companies::class)->name('companies');
        Route::get('orders', Dashboard::class)->name('orders');
        Route::get('reports', Dashboard::class)->name('reports');
        Route::get('customers', Dashboard::class)->name('customers');
    });
});
