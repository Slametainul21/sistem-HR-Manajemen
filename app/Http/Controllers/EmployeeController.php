<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('search');

        $query = Material::with(['category', 'departments'])
            ->whereHas('departments', function($q) use ($user) {
                $q->where('department_id', $user->department_id);
            })
            ->where('archived', false);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $materials = $query->latest()->paginate(10);
        
        return view('employee.index', compact('materials'));
    }
}