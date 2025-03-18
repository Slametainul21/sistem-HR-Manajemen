<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Material;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request, Material $material)
    {
        $validated = $request->validate([
            'content' => 'required|string'
        ]);

        $feedback = $material->feedbacks()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content']
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully');
    }

    public function review(Feedback $feedback)
    {
        return view('feedbacks.review', compact('feedback'));
    }

    public function storeReview(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'hr_response' => 'required|string'
        ]);

        $feedback->update([
            'hr_response' => $validated['hr_response'],
            'status' => 'reviewed'
        ]);

        return redirect()->back()->with('success', 'Feedback reviewed successfully');
    }
}