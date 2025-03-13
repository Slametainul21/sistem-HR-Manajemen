<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Material;

class DashboardController extends Controller
{
    public function index()
    {
        $materials = Material::with('category')
            ->where('archived', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('hr.index', compact('materials'));
    }
}