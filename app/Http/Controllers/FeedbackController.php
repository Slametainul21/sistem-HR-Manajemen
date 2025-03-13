<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:tbl_materials,id',
            'feedback' => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $feedback = new Feedback($request->all());
        $feedback->user_id = auth()->id();
        $feedback->created_by = auth()->id();
        $feedback->save();

        return redirect()->back()->with('success', 'Feedback submitted successfully');
    }
}