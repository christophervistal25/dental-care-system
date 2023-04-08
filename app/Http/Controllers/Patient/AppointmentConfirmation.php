<?php

namespace App\Http\Controllers\Patient;

use App\Admin;
use App\Appointment;
use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;

class AppointmentConfirmation extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:patient');
    }

    public function print(Appointment $appointment)
    {
        $mobile_no = Admin::MOBILE_NO;
        $pdf = SnappyPdf::loadView('patient.appointment.print_forms.confirmation', compact('appointment', 'mobile_no'));

        return $pdf->inline();
    }
}
