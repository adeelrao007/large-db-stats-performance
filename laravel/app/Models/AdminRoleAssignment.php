<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRoleAssignment extends Model
{
    protected $table = 'admin_role_assignments';
    public $timestamps = false;

    protected $fillable = [
        'admin_user_id',
        'role_id',
    ];

    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
