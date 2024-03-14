<?php

use App\Http\Controllers\Auth\PatientAuthController;
use App\Http\Controllers\Patients\PatientDashboardController;
use App\Livewire\Dashboard\Chats\CreateChat;
use App\Livewire\Dashboard\Chats\Main;
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
            //############################# patients route ##########################################
            Route::get('invoices', [PatientDashboardController::class, 'invoices'])->name('invoices.patient');
            Route::get('laboratories', [PatientDashboardController::class, 'laboratories'])->name('laboratories.patient');
            Route::get('view_laboratories/{id}', [PatientDashboardController::class, 'viewLaboratories'])->name('laboratories.view');
            Route::get('rays', [PatientDashboardController::class, 'rays'])->name('rays.patient');
            Route::get('view_rays/{id}', [PatientDashboardController::class, 'viewRays'])->name('rays.view');
            Route::get('payments', [PatientDashboardController::class, 'payments'])->name('payments.patient');
            //############################# end patients route ######################################
            //############################# Chat route ##########################################
            Route::get('list/doctors', CreateChat::class)->name('list.doctors');
            Route::get('chat/doctors', Main::class)->name('chat.doctors');

        //############################# end Chat route ######################################
        });


   require __DIR__ . '/auth.php';
        Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
    });//end route of livewire

    }
  ); //end route of localization
