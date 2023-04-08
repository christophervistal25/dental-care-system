<?php

namespace App\Http\Controllers;

use App\Patient;
use App\PatientInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:patient');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('appointment.index');

        return view('patient.dashboard');
    }

    public function edit()
    {
        $patient = Patient::with('info')->find(Auth::user()->id);

        return view('patient.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $rules = [
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'username' => 'required|unique:patients,username,'.$patient->id,
            'mobile_no' => 'required|unique:patients,mobile_no,'.$patient->id,
            'age' => 'required|numeric',
            'birthdate' => 'date',
            'martial_status' => ['required', Rule::in(['Single', 'Married', 'Divorced', 'Widowed'])],
            'sex' => ['required', Rule::in(['Male', 'Female', 'Choose not to say'])],
            'occupation' => 'required',
            'home_address' => 'required',
            'profile' => 'nullable',
        ];

        if (! is_null($request->passwoord) || ! is_null($request->password_confirmation)) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        $this->validate($request, $rules);

        if ($request->has('profile')) {
            $image = $request->file('profile');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $image_path = 'images/'.$image_name;
            $patient->profile = $image_path;
        }

        $information = new PatientInformation();
        $information->nickname = $request->nickname;
        $information->birthdate = $request->birthdate;
        $information->martial_status = $request->martial_status;
        $information->sex = $request->sex;
        $information->age = $request->age;
        $information->occupation = $request->occupation;
        $information->home_address = $request->home_address;

        $patient->firstname = $request->firstname;
        $patient->middlename = $request->middlename;
        $patient->lastname = $request->lastname;
        $patient->username = $request->username;
        $patient->mobile_no = $request->mobile_no;

        if (! is_null($request->password)) {
            $patient->password = $request->password;
        }

        if (! is_null($patient->info)) {
            $patient->info->delete();
        }

        $patient->save();
        $patient->info()->save($information);

        return back()->with('success', 'Your profile has been updated successfully.');
    }
}
