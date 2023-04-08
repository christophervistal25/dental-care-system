<?php

namespace App\Http\Controllers\Admin;

use App\Examination;
use App\Http\Controllers\Controller;
use App\Service;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function generate(string $start, string $end)
    {
        $services = Service::pluck('name')->toArray();
        $start = Carbon::parse($start)->format('Y-m-d');
        $end = Carbon::parse($end)->format('Y-m-d');
        $reports = Examination::with(['patient:id,firstname,middlename,lastname', 'payments'])->whereDate('created_at', '>=', $start)
                                    ->whereDate('created_at', '<=', $end)
                                    ->get(['patient_id', 'created_at', 'id']);

        $serviceWithReports = $reports->pluck('payments.service_rendered')->toArray();

        foreach ($services as $key => $service) {
            if (in_array($service, $serviceWithReports)) {
                unset($services[$key]);
            }
        }

        $noOfPatients = $reports->pluck('patient')->unique()->count();

        return response()->json(['services' => array_values($services), 'reports' => $reports->groupBy('payments.service_rendered'), 'total_count' => $noOfPatients]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    public function show()
    {
        return view('admin.reports.daily');
    }
}
