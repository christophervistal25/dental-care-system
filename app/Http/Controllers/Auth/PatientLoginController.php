<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:patient')->except('logout');
    }

    public function login()
    {
        return view('patient.auth.login');
    }

    public function username()
    {
        return 'username';
    }

    public function loginPatient(Request $request)
    {
        if (Auth::guard('patient')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('patient.dashboard');
        }

        return redirect()->back()->withInput($request->only('username', 'remember'))
            ->withErrors(['message' => 'Invalid username or Password.']);
    }

    public function logout()
    {
        Auth::guard('patient')->logout();

        return redirect()->route('patient.auth.login');
    }
}
