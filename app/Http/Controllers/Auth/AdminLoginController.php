<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    public function username(): string
    {
        return 'username';
    }

    public function loginAdmin(Request $request)
    {
        // Attempt to log the user in
        if (auth()->guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withInput($request->only('username', 'remember'))
            ->withErrors(['message' => 'Invalid Username or Password.']);
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.auth.login');
    }
}
