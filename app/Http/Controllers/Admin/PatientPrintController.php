<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Patient;
use Barryvdh\Snappy\Facades\SnappyPdf;

class PatientPrintController extends Controller
{
    public function print()
    {
        $patients = Patient::orderBy('created_at', 'DESC')
            ->with(['info'])->get();

        $pdf = SnappyPdf::loadView('admin.patients.print', compact('patients'));

        return $pdf->inline();
    }
}
