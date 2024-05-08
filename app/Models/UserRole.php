<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'user_roles';

    protected $fillable = [
        'user_id',
        'role_id',
        'q_m_s_processes_id',
        'q_m_s_roles_id',
        'q_m_s_divisions_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
