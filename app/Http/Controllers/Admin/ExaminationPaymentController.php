<?php

namespace App\Http\Controllers\Admin;

use App\Examination;
use App\Http\Controllers\Controller;
use App\Http\Repositories\SMSRepository;
use App\Payment;
use App\Service;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Riskihajar\Terbilang\Facades\Terbilang;

class ExaminationPaymentController extends Controller
{
    public function __construct(SMSRepository $smsRepository)
    {
        $this->middleware('auth:admin');
        $this->smsRepository = $smsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Examination  $id
     * @param  No of tooth  $noOfTooth
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, int $noOfTooth, $service_rendered)
    {
        $examination = Examination::with('patient')->find($id);
        $service = Service::find($service_rendered);

        return view('admin.payment.create', compact('examination', 'noOfTooth', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Examination ID int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $examination = Examination::with(['patient', 'doctor'])->find($id);
        $services = Service::get(['id', 'name', 'price', 'per_each']);

        $payment = Payment::find($id) ?? new Payment();
        $payment->service_rendered = $request->service_rendered;
        $payment->fee = $request->service_amount;
        $payment->paid = $request->fee;
        $payment->balance = $request->service_amount - $request->fee;
        $examination->payments()->save($payment);

        $feeInWords = ucfirst(Terbilang::make($payment->fee));

        $pdf = SnappyPdf::loadView('admin.payment.print', compact('examination', 'payment', 'feeInWords'));

        $pdf->setPaper('a4');
        $pdf->setOrientation('landscape');

        return $pdf->inline();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
