<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'tbl_feedbacks';

    protected $fillable = [
        'material_id',
        'user_id',
        'feedback',
        'rating',
        'status',
        'status_read',
        'created_by',
        'updated_by',
        'archived'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(FeedbackReview::class, 'feedback_id');
    }
}