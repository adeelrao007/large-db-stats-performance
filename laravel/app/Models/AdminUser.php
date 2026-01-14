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

    public function hasPermission(string $permission): bool
    {
        static $permissions;

        if ($permissions === null) {
            $permissions = $this->roles()
                ->with('permissions:name')
                ->get()
                ->pluck('permissions')
                ->flatten()
                ->pluck('name')
                ->unique()
                ->toArray();
        }

        return in_array($permission, $permissions);
    }


}

