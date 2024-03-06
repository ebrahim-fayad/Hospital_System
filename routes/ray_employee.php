<?php

use App\Http\Controllers\Auth\RayEmployeeController;
use App\Http\Controllers\Rays\RayInvoicesController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Ray_Employee Routes
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
        Route::middleware(['auth:ray_employee'])->group(function () {
            Route::get('ray_employee/dashboard', [RayEmployeeController::class, 'index'])->name('ray_employee.dashboard');
            Route::resource('Rays_Invoices', RayInvoicesController::class);
            Route::get('completed_Ray_Invoices', [RayInvoicesController::class, 'completedRayInvoices'])->name('completedRayInvoices');
        });//end middleware of  auth:ray_employee








        });//end route of localization

        require __DIR__ . '/auth.php';
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });//end route of livewire

