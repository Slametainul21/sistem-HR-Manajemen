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

    public function storeReview(Request $request, $materialId)
    {
        $request->validate([
            'feedback' => 'required|string|max:500',
        ]);

        Feedback::create([
            'material_id' => $materialId,
            'user_id' => auth()->id(),
            'content' => $request->feedback,
        ]);

        return back()->with('success', 'Feedback berhasil dikirim.');
    }
}
