<?php

use App\Http\Controllers\Auth\PatientAuthController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| patients Routes
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
        Route::middleware(['auth:patient'])->group(function () {
            Route::get('patient/dashboard',[PatientAuthController::class,'index'])->name('patient.dashboard');

        });


   require __DIR__ . '/auth.php';
        Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
    });//end route of livewire

    }
  ); //end route of localization
