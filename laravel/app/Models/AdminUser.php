<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'admin_users';

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'admin_role_assignments'
        );
    }
}

