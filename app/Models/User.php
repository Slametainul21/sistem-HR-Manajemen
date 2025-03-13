<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_users';

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'department_id'
    ];    

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function isHR()
    {
        return $this->role_id === 0;
    }

    public function canAccessMaterial(Material $material)
    {
        if ($this->isHR()) {
            return true;
        }

        return $material->departments()->where('department_id', $this->department_id)->exists();
    }
}
