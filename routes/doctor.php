<?php

use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Doctor\Diagnostics\DiagnosticController;
use App\Http\Controllers\Doctor\Invoices\InvoiceController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::middleware('auth:doctor')->group(function () {
            Route::get('doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
            Route::prefix('Doctor')->group(function () {
                Route::resource('invoices', InvoiceController::class);
                Route::resource('Diagnostics', DiagnosticController::class);
            });

        });

        require __DIR__ . '/auth.php';
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
    }
);
