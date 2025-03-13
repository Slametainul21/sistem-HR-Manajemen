<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('auth.register', compact('roles', 'departments'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tbl_users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:tbl_roles,id',
            'department_id' => 'required|exists:tbl_departments,id',
        ]);

        // If role is HR (0), force department to HR (0)
        $department_id = $request->role_id == 0 ? 0 : $request->department_id;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'department_id' => $department_id,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
