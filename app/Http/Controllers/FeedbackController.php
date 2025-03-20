<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\FeedbackReview;
use App\Models\Material;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request, Material $material)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500'
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'material_id' => $material->id,
            'content' => $validated['content'],
            'status' => 'pending' // Status awal feedback
        ]);

        return redirect()->back()->with('success', 'Feedback berhasil dikirim.');
    }

    public function review(Feedback $feedback)
    {
        return view('feedbacks.review', compact('feedback'));
    }

    public function storeReview(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'review' => 'required|string|max:500',
            'score' => 'required|integer|min:1|max:5',
            'status' => 'required|in:approved,rejected,noted'
        ]);

        // Simpan review ke tabel tbl_feedback_reviews
        FeedbackReview::create([
            'feedback_id' => $feedback->id,
            'hr_id' => auth()->id(),
            'review' => $validated['review'],
            'score' => $validated['score'],
            'status' => $validated['status'],
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
            'archived' => 0
        ]);

        // Update status feedback
        $feedback->update([
            'hr_response' => $validated['review'],
            'status' => 'reviewed'
        ]);

        return back()->with('success', 'Review berhasil disimpan.');
    }
}
