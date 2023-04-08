<?php

use App\Appointment;
use App\CloseDay;
use App\Doctor;
use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Repositories\AppointmentRepository;
use App\Patient;
use App\PatientInformation;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('doctors', function () {
    return Doctor::get();
});

Route::get('services', function () {
    return Service::get();
});

Route::get('close-days', function () {
    return CloseDay::get();
});

function generateJsonArray($availables)
{
    $jsonArray = [];
    foreach ($availables as $available) {
        $jsonArray[] = ['available' => $available];
    }

    return json_encode($jsonArray);
}

Route::post('/appointment/available', function (Request $request) {

    $appointmentRepo = app()->make(AppointmentRepository::class);

    [$month, $day, $year] = explode('-', $request->date);

    $service = Service::find($request->serviceId);

    $appointments = DB::table('appointments')
        ->where('doctor_id', $request->doctorId)
        ->whereMonth('start_date', $month)
        ->whereDay('start_date', $day)
        ->whereYear('start_date', $year)
        ->where('status', '!=', 'cancelled')
        ->orderBy('start_date', 'ASC')
        ->get(['start_date', 'end_date']);

    return response()->json(['availables' => $appointmentRepo->availables($request->date, $service->duration, $appointments)]);
});

Route::post('patient-appointments', function (Request $request) {
    return Patient::with(['appointments' => function ($query) {
        $query->where('status', 'active');
    }, 'appointments.service', 'appointments.doctor'])->where('username', $request->username)?->first()?->appointments;
});

Route::post('appointment-avail', function (Request $request) {
    return DB::transaction(function () use ($request) {
        [$start, $end] = explode(' - ', $request->time);

        $appointment = Appointment::create([
            'service_id' => $request->serviceId,
            'doctor_id' => $request->doctorId,
            'start_date' => Carbon::parse($start),
            'end_date' => Carbon::parse($end),
        ]);

        $patient = Patient::where('username', $request->patient)->first();

        $appointment->patients()->attach($patient);

        return response()->json(['success' => true], 200);
    });
});

Route::post('appointment', [AppointmentController::class, '@store']);

Route::post('account/login', function (Request $request) {
    $validatedData = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    Log::info('logging : '.$request->username);
    Log::info('logging : '.$request->password);

    $user = Patient::where('username', $validatedData['username'])->first();

    if ($user && Hash::check($validatedData['password'], $user->password)) {
        return response()->json(['code' => 200, 'firstname' => ucfirst($user->firstname), 'middlename' => ucfirst($user->middlename), 'lastname' => ucfirst($user->lastname), 'suffix' => ucfirst($user->suffix)], 200);
    } else {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
});

Route::post('account/register', function (Request $request) {
    $patient = new Patient();
    $information = new PatientInformation();

    $information->birthdate = $request->birthday;
    $information->martial_status = $request->status;
    $information->sex = $request->gender;
    $information->age = Carbon::parse($request->birthday)->age;
    $information->occupation = $request->occupation;
    $information->home_address = $request->address;

    $patient->firstname = $request->firstname;
    $patient->middlename = $request->middlename;
    $patient->lastname = $request->lastname;
    $patient->username = $request->username;
    $patient->mobile_no = $request->contactNumber;
    $patient->password = $request->password;

    $patient->save();
    $patient->info()->save($information);

    return response()->json([
        'success' => true,
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'suffix' => $request->suffix,
        'username' => $request->username,
    ]);
});
