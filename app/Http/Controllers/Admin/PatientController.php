<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\AddRequest;
use App\Http\Requests\Patient\EditRequest;
use App\Patient;
use App\PatientInformation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $patients = Patient::with('info')
            ->withCount('examinations')
            ->get();

        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AddRequest $request)
    {
        DB::beginTransaction();
        try {
            $patient = Patient::create($request->all());
            $information = new PatientInformation();

            // $information->nickname       = $request->nickname;
            $information->birthdate = $request->birthdate;
            $information->martial_status = $request->martial_status;
            $information->sex = $request->sex;
            $information->occupation = $request->occupation;
            $information->home_address = $request->home_address;
            $information->age = $request->age;
            $patient->name = $request->name;
            $patient->username = $request->username;
            $patient->mobile_no = $request->mobile_no;
            $patient->info()->save($information);
            DB::commit();

            return back()->with('success', 'Succesfully add new patient')->with('patient_id', $patient->id)->with('patient_no', $patient->patient_number);
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollback();
        }
    }

    public function searchPatient(string $key)
    {
        return Patient::with('info')->where('patient_number', $key)
            ->orWhere('patient_number', 'like', '%'.$key.'%')
            ->orWhere('firstname', 'like', '%'.$key.'%')
            ->orWhere('lastname', 'like', '%'.$key.'%')
            ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(EditRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $patient = Patient::with('info')->find($id);

            $info = $patient->info;
            $info->nickname = $request->nickname;
            $info->birthdate = $request->birthdate;
            $info->martial_status = $request->martial_status;
            $info->sex = $request->sex;
            $info->occupation = $request->occupation;
            $info->home_address = $request->home_address;
            $info->age = $request->age;

            $patient->firstname = $request->firstname;
            $patient->middlename = $request->middlename;
            $patient->lastname = $request->lastname;
            $patient->username = $request->username;
            $patient->mobile_no = $request->mobile_no;

            $patient->save();
            $patient->info()->save($info);
            DB::commit();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
