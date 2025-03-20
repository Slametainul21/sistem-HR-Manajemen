<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Material;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Material::with(['category', 'departments'])
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            });

        $materials = $query->latest()->get();
        $employeeCount = User::where('role_id', 1)->count(); // Count employees only

        return view('hr.index', compact('materials', 'employeeCount'));
    }
}