<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackReview extends Model
{
    protected $table = 'tbl_feedback_reviews';

    protected $fillable = [
        'feedback_id',
        'hr_id',
        'review',
        'score',
        'status',
        'created_by',
        'updated_by',
        'archived'
    ];

    public function feedbacks()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }

    public function hr()
    {
        return $this->belongsTo(User::class, 'hr_id');
    }
}