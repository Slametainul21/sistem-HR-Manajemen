<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $materials = Material::with(['category', 'departments'])
            ->whereHas('departments', function($query) use ($user) {
                $query->where('department_id', $user->department_id);
            })
            ->where('archived', false)
            ->get();

        return view('employee.index', compact('materials'));
    }
}