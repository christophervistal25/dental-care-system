<?php

namespace App\Http\Controllers\Admin;

use App\Examination;
use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;

class ExaminationHistoryPrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function print($recordIds)
    {
        preg_match_all('!\d+!', $recordIds, $ids);
        $ids = array_shift($ids);
        $records = Examination::with('teeths:id,examination_id,tooth_description,surface,treatment')->find($ids, ['id', 'created_at']);
        $pdf = SnappyPdf::loadView('admin.examinationrecords.print', compact('records'));

        return $pdf->inline();
    }
}
