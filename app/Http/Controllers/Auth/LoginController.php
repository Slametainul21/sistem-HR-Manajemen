<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

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
