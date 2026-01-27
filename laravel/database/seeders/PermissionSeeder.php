<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $sql = "TRUNCATE TABLE `permissions`;
";
        $permissions = [
            ['id' => 1, 'name' => 'users.create', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'users.update', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'users.delete', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'users.view', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'products.create', 'guard_name' => 'web'],
            ['id' => 6, 'name' => 'products.update', 'guard_name' => 'web'],
            ['id' => 7, 'name' => 'orders.view', 'guard_name' => 'web'],
            ['id' => 8, 'name' => 'orders.refund', 'guard_name' => 'web'],
            ['id' => 9, 'name' => 'users.ban', 'guard_name' => 'web'],
            ['id' => 10, 'name' => 'chat.moderate', 'guard_name' => 'web'],
            ['id' => 11, 'name' => 'admin.manage', 'guard_name' => 'web'],
        ];
        foreach ($permissions as $permission) {
            $sql .= sprintf(
                "INSERT INTO `permissions` (`id`, `name`, `guard_name`) VALUES (%d, '%s', '%s');\n",
                $permission['id'],
                addslashes($permission['name']),
                addslashes($permission['guard_name'])
            );
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
