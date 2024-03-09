<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RayEmployeeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\LaboratoryEmployeeController;
use App\Http\Controllers\Auth\PatientAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //             ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
    ############################################# User Route ##################################################
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    ####################################  user Route #################################################
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('user.login');
    ####################################  Admin Route #################################################
    Route::post('login/admin', [AdminController::class, 'store'])->name('admin.login');
    ###################################################################################################
    ####################################  Doctor Route #################################################
    Route::post('login/doctor', [DoctorController::class, 'store'])->name('doctor.login');
    ###################################################################################################
    ####################################  Ray_Employee Route #################################################
    Route::post('login/ray_employee', [RayEmployeeController::class, 'store'])->name('ray_employee.login');
    ###################################################################################################
    ####################################  Laboratory_Employee Route #################################################
    Route::post('login/laboratory_employee', [LaboratoryEmployeeController::class, 'store'])->name('laboratory_employee.login');
    ###################################################################################################
    ####################################  Patient Route #################################################
    Route::post('login/patient', [PatientAuthController::class, 'store'])->name('patients.login');
    ###################################################################################################
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('user.logout');
});
Route::post('logout/admin', [AdminController::class, 'destroy'])->name('logout.admin');
Route::post('logout/doctor', [DoctorController::class, 'destroy'])->name('doctor.logout');
Route::post('logout/ray_employee', [RayEmployeeController::class, 'destroy'])->name('ray_employee.logout');
Route::post('logout/laboratory_employee', [LaboratoryEmployeeController::class, 'destroy'])->name('laboratory_employee.logout');
Route::post('logout/patient', [PatientAuthController::class, 'destroy'])->name('patient.logout');
