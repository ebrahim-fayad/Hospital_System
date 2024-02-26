<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Models\Invoice;
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
        Route::get('user/dashboard', function () {
            return view('Dashboard.Users.index');
        })->middleware(['auth:web'])->name('user.dashboard');

     
        Route::middleware('auth:admin')->group(function () {
            Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
            #################################### Sections Route ##############################
            Route::resource('Sections', SectionController::class);
            #################################### Doctors Route ##############################
            Route::resource('Doctors', DoctorController::class);
            Route::post('Doctors/update_password/{id}', [DoctorController::class, 'update_password'])->name('Doctors.update_password');
            Route::post('Doctors/update_status/{id}', [DoctorController::class, 'update_status'])->name('Doctors.update_status');
            #################################### Services Route ##############################
            Route::resource('Services', ServiceController::class);
            Route::get('print_invoice/{id}', function ($id) {
                $single_invoice = Invoice::findOrFail($id);
                return view('Dashboard.Invoices.SingleInvoice.print',compact('single_invoice'));

            })->name('print_invoice');
            Route::view('Add_GroupServices', 'Dashboard.group.index')->name('Add_GroupServices');
            #################################### Insurance Route ##############################
            Route::resource('Insurances', InsuranceController::class);
            #################################### Ambulance Route ##############################
            Route::resource('Ambulances', AmbulanceController::class);
            #################################### Patient Route ##############################
            Route::resource('Patients', PatientController::class);
            #################################### Single_Invoice Route ##############################
            Route::view('single_invoice', 'Dashboard.Invoices.SingleInvoice.index')->name('single_invoice');
            //############################# end Single_Invoice route ######################################
            #################################### invoices_Group Route ##############################
            Route::view('invoices_Group', 'Dashboard.Invoices.InvoicesGroup.index')->name('invoices_Group');
            //############################# end invoices_Group route ######################################
            //############################# Receipt route ##########################################
            Route::resource('Receipt', ReceiptAccountController::class);
            //############################# end Receipt route ######################################
            //############################# Payment route ##########################################
            Route::resource('Payment', PaymentAccountController::class);
            //############################# end Payment route ######################################
        });

        require __DIR__ . '/auth.php';
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
    }
);
