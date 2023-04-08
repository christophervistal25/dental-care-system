<?php

use App\Http\Controllers\Auth\PatientLoginController;
use App\Http\Controllers\Patient\AppointmentConfirmation;
use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'patient'], function () {
    Route::get('/', [PatientController::class, 'index'])->name('patient.dashboard');
    Route::get('dashboard', [PatientController::class, 'index'])->name('patient.dashboard');
    Route::post('logout', [PatientLoginController::class, 'logout'])->name('patient.auth.logout');
    Route::get('login', [PatientLoginController::class, 'login'])->name('patient.auth.login');
    Route::post('login', [PatientLoginController::class, 'loginPatient'])->name('patient.auth.loginPatient');

    Route::get('register', [PatientRegisterController::class, 'register'])->name('patient.auth.register');
    Route::post('register', [PatientRegisterController::class, 'registerPatient'])->name('patient.auth.registerPatient');

    Route::get('/appointment/available/{date}/{doctorId}/{serviceDuration}', [AppointmentController::class, 'getAvailables']);

    Route::get('/appointment/confirmation/{appointment}', [AppointmentConfirmation::class, 'print']);

    Route::get('appointment/cancel/{appointment}', [AppointmentController::class, 'cancel'])
        ->name('appointment.cancel');

    Route::resource('appointment', AppointmentController::class);

    Route::get('/edit', [PatientController::class, 'edit'])->name('account.settings');
    Route::put('/edit/{patient}', [PatientController::class, 'update'])->name('account.settings.update');
});
