<?php

namespace App\Policies;

use App\Models\AdminUser;
use App\Models\User;

class UserPolicy
{
    public function viewAny(AdminUser $admin)
    {
        return $admin->hasPermission('users.view');
    }

    public function view(AdminUser $admin, User $user)
    {
        return $admin->hasPermission('users.view');
    }

    public function create(AdminUser $admin)
    {
        return $admin->hasPermission('users.create');
    }

    public function update(AdminUser $admin, User $user)
    {
        return $admin->hasPermission('users.update');
    }

    public function delete(AdminUser $admin, User $user)
    {
        return $admin->hasPermission('users.delete');
    }
}
