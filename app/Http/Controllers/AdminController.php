<?php

namespace App\Http\Controllers;

use App\Admin;
use App\CloseDay;
use App\Doctor;
use App\Patient;
use App\Service;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Doctor::withCount(['appointments' => function ($query) {
            $query->whereDate('start_date', date('Y-m-d'));
        }])->where('active', 'active')->get();

        $services = Service::count();
        $doctorsCount = Doctor::count();
        $patientsCount = Patient::count();
        $closeDaysCount = CloseDay::count();

        return view('admin.dashboard', compact(
            'appointments',
            'doctorsCount',
            'patientsCount',
            'services',
            'closeDaysCount',
        ));
    }

    public function edit()
    {
        return view('admin.auth.edit');
    }

    public function update(Request $request, Admin $admin)
    {
        $rules = [
            'name' => 'required',
            'username' => 'required|unique:admins,username,'.$admin->id,
            'profile ' => 'nullable',
        ];

        if (! is_null($request->password) || ! is_null($request->password_confirmation)) {
            $rules['password'] = $rules['password'] = 'required|min:8|confirmed';
        }

        $this->validate($request, $rules);

        if ($request->has('profile')) {
            $image = $request->file('profile');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $image_path = 'images/'.$image_name;
            $admin->profile = $image_path;
        }

        $admin->name = $request->name;
        $admin->username = $request->username;

        if (! is_null($request->password)) {
            $admin->password = $request->password;
        }
        $admin->save();

        return back()->with('success', 'Your profile has been successfully updated.');
    }
}
