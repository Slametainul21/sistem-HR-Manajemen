<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'tbl_materials';

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'link',
        'category_id',
        'uploaded_by',
        'views',
        'created_by',
        'updated_by',
        'archived'
    ];

    public function category()
    {
        return $this->belongsTo(MaterialCategory::class, 'category_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'tbl_materials_departments', 'material_id', 'department_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}