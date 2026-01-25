<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('role_has_permissions')->truncate();
        DB::table('role_has_permissions')->insert([
            // Admin has all permissions
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 1],
            ['permission_id' => 4, 'role_id' => 1],
            // Manager can view and update users
            ['permission_id' => 2, 'role_id' => 3],
            ['permission_id' => 4, 'role_id' => 3],
            // User can only view users
            ['permission_id' => 4, 'role_id' => 2],
        ]);
    }
}
