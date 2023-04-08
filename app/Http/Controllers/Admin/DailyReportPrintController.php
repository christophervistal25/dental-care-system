<?php

namespace App\Http\Controllers\Admin;

use App\Examination;
use App\Http\Controllers\Controller;
use App\Service;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;

class DailyReportPrintController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Wondering while the same ?
     * We can create a same method for this but sometimes we need some extra data for
     * print so I keep it like this just to ensure some future upgrade of the app.
     */
    public function print()
    {
        $services = Service::pluck('name')->toArray();

        $start = Carbon::parse(Carbon::now())->format('Y-m-d');
        $end = Carbon::parse(Carbon::now())->format('Y-m-d');

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
        $reports = $reports->groupBy('payments.service_rendered');

        $pdf = SnappyPdf::loadView('admin.reports.daily-print', compact('services', 'reports', 'noOfPatients'));

        return $pdf->stream();
    }
}
