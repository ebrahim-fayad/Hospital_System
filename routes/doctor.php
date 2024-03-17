<?php

use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Doctor\Diagnostics\DiagnosticController;
use App\Http\Controllers\Doctor\Invoices\InvoiceController;
use App\Http\Controllers\Doctor\Laboratories\LaboratoryController;
use App\Http\Controllers\Doctor\Rays\RayController;
use App\Livewire\Dashboard\Chats\CreateChat;
use App\Livewire\Dashboard\Chats\Main;
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
                //############################# completed_invoices route ##########################################
                Route::get('completed_invoices', [InvoiceController::class, 'completedInvoices'])->name('completedInvoices');
                //############################# end invoices route ################################################

                //############################# review_invoices route ##########################################
                Route::get('review_invoices', [InvoiceController::class, 'reviewInvoices'])->name('reviewInvoices');
            //############################# end invoices route #############################################
                //############################# review_invoices route ##########################################
                Route::get('laboratoryInvoice/{id}', [InvoiceController::class, 'laboratoryInvoice'])->name('laboratoryInvoice');
            //############################# end invoices route #############################################

                Route::resource('Diagnostics', DiagnosticController::class);
                //############################# review_invoices route ##########################################
                Route::post('add_review', [DiagnosticController::class, 'addReview'])->name('add_review');
            //############################# end invoices route #############################################
            });
            //############################# rays route ##########################################

            Route::resource('rays', RayController::class);

            //############################# end rays route ######################################
            //############################# Laboratories route ##########################################

            Route::resource('Laboratories', LaboratoryController::class);

            //############################# end rays Laboratories ######################################
            //############################# Chat route ##########################################
            Route::get('list/patients', CreateChat::class)->name('list.patients');
            Route::get('chat/patients', Main::class)->name('chat.patients');

        //############################# end Chat route ######################################

            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name('404');
        });//end middleware doctor

        require __DIR__ . '/auth.php';
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });//end route livewire localization
 });//end route localization
