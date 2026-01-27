<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $sql = "TRUNCATE TABLE `role_permissions`;
";
        $rolePermissions = [
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 1, 'permission_id' => 4],
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 6],
            ['role_id' => 1, 'permission_id' => 7],
            ['role_id' => 1, 'permission_id' => 8],
            ['role_id' => 1, 'permission_id' => 9],
            ['role_id' => 1, 'permission_id' => 10],
            ['role_id' => 1, 'permission_id' => 11],
            ['role_id' => 3, 'permission_id' => 7],
            ['role_id' => 3, 'permission_id' => 8],
        ];
        foreach ($rolePermissions as $rp) {
            $sql .= sprintf(
                "INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES (%d, %d);\n",
                $rp['role_id'],
                $rp['permission_id']
            );
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
