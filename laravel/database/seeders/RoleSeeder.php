<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $sql = "TRUNCATE TABLE `roles`;
";
        $roles = [
            ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'User', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'Manager', 'guard_name' => 'web'],
        ];
        foreach ($roles as $role) {
            $sql .= sprintf(
                "INSERT INTO `roles` (`id`, `name`, `guard_name`) VALUES (%d, '%s', '%s');\n",
                $role['id'],
                addslashes($role['name']),
                addslashes($role['guard_name'])
            );
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
