<?php

use App\Examination;
use App\Patient;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::redirect('login', '/patient/login', 301);

Route::get('examination-record/{username}', function (string $username) {
      $patient = Patient::with(['examinations', 'examinations.doctor', 'examinations.teeths', 'examinations.payments'])->where('username', $username)->first();

      return view('patient-v2.examinations', compact('patient'));
});

Route::get('examination-record-view/{id}', function (int $id) {
      $record = Examination::with(['teeths'])->find($id);

      return view('patient-v2.show', compact('record'));
})->name('patient-v2.examination-record-view');
