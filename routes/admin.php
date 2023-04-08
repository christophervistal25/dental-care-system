<?php

use App\Http\Controllers\Admin\CloseDaysController;
use App\Http\Controllers\Admin\DailyReportPrintController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ExaminationHistoryPrintController;
use App\Http\Controllers\Admin\ExaminationPaymentController;
use App\Http\Controllers\Admin\GeneratedReportPrintController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PatientExaminationRecordController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('login', [AdminLoginController::class, 'login'])->name('admin.auth.login');
    Route::post('login', [AdminLoginController::class, 'loginAdmin'])->name('admin.auth.loginAdmin');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.auth.logout');
    Route::get('/account/setting', [AdminController::class, 'edit'])->name('admin.account.setting');
    Route::put('/account/setting/{admin}', [AdminController::class, 'update'])->name('admin.update.account.setting');

    Route::resource('doctor', DoctorController::class);
    Route::resource('service', ServiceController::class);

    Route::get('/doctor/appointment/{doctorId}/{date}', [DoctorAppointmentPrintController::class, 'print']);
    Route::resource('doctorappointment', DoctorAppointmentController::class);

    Route::get('/patient/search/{name}', [PatientController::class, 'searchPatient']);
    Route::resource('patient', PatientController::class);
    Route::get('/patient/list/print', [PatientPrintController::class, 'print'])->name('patient.list-print');

    Route::get('/patient/examination/record/{patient}', [PatientExaminationRecordController::class, 'create'])->name('patient.examination.record.create');
    Route::post('/patient/examination/record/{patient}', [PatientExaminationRecordController::class, 'store'])->name('patient.examination.record.store');
    Route::get('/patient/examination/history/{patient}', [PatientExaminationRecordController::class, 'history'])->name('patient.examination.history');

    Route::get('/patient/examination/{patient}', [PatientExaminationRecordController::class, 'show'])->name('patient.examination.show');
    Route::get('/patient/examination/edit/{patient}', [PatientExaminationRecordController::class, 'edit'])->name('patient.examination.edit');

    Route::put('/patient/examination/edit/{patient}', [PatientExaminationRecordController::class, 'update'])->name('patient.examination.update');

    Route::get('/examination/{id}/{noOfTooth}/{service_rendered}/payment', [ExaminationPaymentController::class, 'edit']);
    Route::put('/examination/{id}/payment', [ExaminationPaymentController::class, 'update']);

    Route::get('/patient/examination/history/print/{ids}', [ExaminationHistoryPrintController::class, 'print']);

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/generate/{start}/{end}', [ReportsController::class, 'generate']);
        Route::get('/daily', [ReportsController::class, 'show'])->name('reports.daily');
        Route::get('/daily/print', [DailyReportPrintController::class, 'print'])->name('reports.daily.print');
        Route::get('/{start}/{end}/generated/print', [GeneratedReportPrintController::class, 'print'])->name('reports.generated.print');
    });

    Route::resource('close', CloseDaysController::class);
});
