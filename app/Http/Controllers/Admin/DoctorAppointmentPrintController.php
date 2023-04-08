<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;

class DoctorAppointmentPrintController extends Controller
{
    public function print($doctor, $date)
    {
        [$month, $day, $year] = explode('-', $date);
        $doctor = Doctor::with(['appointments.patients', 'appointments.service', 'appointments' => function ($query) use ($day, $month, $year) {
            $query->orderBy('start_date', 'asc')->whereMonth('start_date', $month)
                ->whereDay('start_date', $day)
                ->whereYear('start_date', $year);
        }])->find($doctor);
        $pdf = SnappyPdf::loadView('admin.doctor.print-appointments', compact('doctor', 'date'));

        return $pdf->inline();
    }
}
