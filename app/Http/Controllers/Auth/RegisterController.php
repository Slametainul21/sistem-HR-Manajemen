<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;  // Add this at the top with other use statements
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (auth()->user()->role_id == 0) { // HR
            return route('hr.index');
        }
        return route('employee.index'); // Employee
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'string', 'in:0,1'],
            'department_id' => ['required', 'exists:tbl_departments,id'],
        ], [
            'password.confirmed' => 'The password confirmation does not match.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'department_id' => $data['department_id'],
        ]);
    }

    public function showRegistrationForm()
    {
        $departments = Department::all();
        $roles = [
            (object)['id' => '0', 'name' => 'HR'],
            (object)['id' => '1', 'name' => 'Employee']
        ];
        return view('auth.register', compact('departments', 'roles'));
    }
}
