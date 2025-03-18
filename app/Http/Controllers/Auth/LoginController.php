<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Add this import
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
            'password' => ['Please check your password and try again.']
        ]);
    }

    // Remove or comment out the default redirect path
    // protected $redirectTo = '/home';

    // Add this method to override the default redirect
    protected function redirectTo()
    {
        if (auth()->user()->isHR()) {
            return route('hr.index');
        }
        return route('employee.index');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
