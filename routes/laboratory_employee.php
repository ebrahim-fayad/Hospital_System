<?php

use App\Http\Controllers\Auth\LaboratoryEmployeeController;
use App\Http\Controllers\Laboratories\LaboratoryInvoiceController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
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
        Route::middleware(['auth:laboratory_employee'])->group(function () {
            Route::get('laboratory_employee/dashboard', [LaboratoryEmployeeController::class, 'index'])->name('ray_employee.dashboard');
            Route::resource('Laboratory_Invoices', LaboratoryInvoiceController::class);
            Route::get('Laboratory_Invoice/completedRayInvoices', [LaboratoryInvoiceController::class, 'completedRayInvoices'])->name('ray_employee.completedRayInvoices');
            Route::get('view_laboratories/{id}', [LaboratoryInvoiceController::class, 'view_laboratories'])->name('view_laboratories');
        }); //end middleware of  auth:ray_employee








    }
); //end route of localization

require __DIR__ . '/auth.php';
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});//end route of livewire

