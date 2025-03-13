<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Feedback;

class HRController extends Controller
{
    public function dashboard() {
        return view('hr.dashboard');
    }

    public function materials() {
        $materials = Material::all();
        return view('hr.materials', compact('materials'));
    }

    public function storeMaterial(Request $request) {
        Material::create($request->all());
        return redirect()->route('hr.materials');
    }

    public function feedbacks() {
        $feedbacks = Feedback::with('material')->get();
        return view('hr.feedbacks', compact('feedbacks'));
    }

    public function reviewFeedback(Request $request) {
        $feedback = Feedback::find($request->id);
        $feedback->update(['status' => $request->status, 'review' => $request->review]);
        return redirect()->route('hr.feedbacks');
    }
}