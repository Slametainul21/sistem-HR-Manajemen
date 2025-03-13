<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Feedback;

class EmployeeController extends Controller
{
    public function dashboard() {
        return view('employee.dashboard');
    }

    public function materials() {
        $materials = Material::all();
        return view('employee.materials', compact('materials'));
    }

    public function viewMaterial($id) {
        $material = Material::find($id);
        return view('employee.view_material', compact('material'));
    }

    public function submitFeedback(Request $request, $id) {
        Feedback::create([
            'material_id' => $id,
            'user_id' => auth()->id(),
            'feedback' => $request->feedback,
            'rating' => $request->rating,
            'status' => 'pending'
        ]);
        return redirect()->route('employee.materials');
    }
}