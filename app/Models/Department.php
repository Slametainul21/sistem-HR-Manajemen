<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'tbl_departments';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'tbl_materials_departments', 'department_id', 'material_id');
    }
}