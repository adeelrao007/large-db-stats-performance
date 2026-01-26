<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoleAssignment extends Model
{
    protected $table = 'user_role_assignments';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
