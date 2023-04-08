<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function __construct(public Doctor $doctor)
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
        $doctors = $this->doctor->get();

        return view('admin.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctor.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birthdate' => ['required', 'date'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'contact_no' => ['required', 'string', 'max:15'],
            'active' => ['required', Rule::in(['active', 'in-active'])],
        ];

        $data = $request->validate($rules);

        // Store the doctor record in the database
        $this->doctor->firstname = $data['firstname'];
        $this->doctor->middlename = $data['middlename'] ?? null;
        $this->doctor->lastname = $data['lastname'];
        $this->doctor->suffix = $data['suffix'] ?? null;
        $this->doctor->gender = $data['gender'];
        $this->doctor->birthdate = $data['birthdate'];
        $this->doctor->contact_no = $data['contact_no'];
        $this->doctor->title = $data['title'];
        $this->doctor->active = $data['active'];

        // Upload the image (if provided) and set the filename in the database
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('doctor_images');
            $this->doctor->image = $imagePath;
        }

        $this->doctor->save();

        return redirect()->route('doctor.create')->with('success', 'Doctor record has been created.');
    }

    /**
     * Display doctors appointments
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        $services = Service::all();

        return view('admin.doctor.appointments', compact('doctor', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.doctor.edit', [
            'doctor' => $this->doctor->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birthdate' => ['required', 'date'],
            'title' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:15'],
            'image' => ['nullable', 'image', 'max:2048'],
            'active' => ['required', Rule::in(['active', 'in-active'])],
        ];

        $data = $request->validate($rules);

        // Retrieve the doctor instance from the database
        $doctor = Doctor::findOrFail($id);

        // Update the doctor record
        $doctor->firstname = $data['firstname'];
        $doctor->middlename = $data['middlename'] ?? null;
        $doctor->lastname = $data['lastname'];
        $doctor->suffix = $data['suffix'] ?? null;
        $doctor->gender = $data['gender'];
        $doctor->birthdate = $data['birthdate'];
        $doctor->title = $data['title'];
        $doctor->contact_no = $data['contact_no'];
        $doctor->active = $data['active'];

        // Upload the image (if provided) and update the filename in the database
        if ($request->hasFile('image')) {
            Storage::delete($doctor->image);
            $imagePath = $request->file('image')->store('doctor_images');
            $doctor->image = $imagePath;
        }

        $doctor->save();

        return redirect()->route('doctor.edit', $id)->with('success', 'Doctor record has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $delete = $doctor->update(['active' => 'in-active']);

        return response()->json(['success' => $delete]);
    }
}
