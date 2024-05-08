<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleGroup extends Model
{
    use HasFactory;

    protected $table = 'role_groups';
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
