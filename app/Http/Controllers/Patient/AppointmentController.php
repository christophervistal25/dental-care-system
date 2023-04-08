<?php

namespace App\Http\Controllers\Patient;

use App\Admin;
use App\Appointment;
use App\CloseDay;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Repositories\AppointmentRepository;
use App\Http\Repositories\SMSRepository;
use App\Patient;
use App\Service;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentRepository $appointmentRepository)
    {
        $this->middleware('auth:patient');
    }

    public function getAvailables(string $date, int $doctorId, string $duration)
    {

        [$month, $day, $year] = explode('-', $date);

        $appointments = DB::table('appointments')
                        ->where('doctor_id', $doctorId)
                        ->whereMonth('start_date', $month)
                        ->whereDay('start_date', $day)
                        ->whereYear('start_date', $year)
                        ->where('status', '!=', 'cancelled')
                        ->get(['start_date', 'end_date']);

        return response()->json(['availables' => $this->appointmentRepository->availables($date, $duration, $appointments)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::getAppointments(Auth::user()->id);

        return view('patient.appointment.index', compact('patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $closeDays = CloseDay::get();
        $doctors = Doctor::active()->get();
        $services = Service::all();

        return view('patient.appointment.create', compact('doctors', 'services', 'closeDays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'service_id' => 'required',
            'doctor' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {

            $appointment = Appointment::create([
                'service_id' => $request->service_id,
                'doctor_id' => $request->doctor,
                'start_date' => Carbon::parse($request->start_date),
                'end_date' => Carbon::parse($request->end_date),
            ]);

            $patient = Patient::find(Auth::user()->id);

            $appointment->patients()->attach($patient);
            DB::commit();

            return response()->json(['success' => true, 'appointment_id' => $appointment->id]);
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $closeDays = CloseDay::allDay();

        return view('patient.appointment.edit', compact('closeDays', 'appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update([
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
        ]);

        // $message = new SendMessageRequest([
        //     'phoneNumber' => Auth::user()->mobile_no,
        //     'message'     =>  "Good Morning/Afternoon this message is to confirm your re-scheduled appointment with {$appointment->doctor->title} {$appointment->doctor->fullname} on {$appointment->start_date->format('l jS \\of F Y h:i:s A')} to {$appointment->end_date->format('h:i:s A')}. Your service is {$appointment->service->name} if you need assistance finding the location, then kindly contact " . Admin::MOBILE_NO . " I appreciate a response from your side confirming the same and don't forget to tell at the clinic that your patient number is " . Auth::user()->patient_number,
        //     'deviceId'    => config('sms.deviceId'),
        // ]);

        // $this->smsRepository->send([$message]);
        return response()->json(['success' => true, 'appointment_id' => $appointment->id]);
    }

    /**
     * Functionality for canceling an appointment.
     */
    public function cancel(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);

        return redirect()->back()->with('status', 'Succesfully cancel the selected appointment.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
