<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        $sql = "TRUNCATE TABLE `admin_users`;
TRUNCATE TABLE `admin_role_assignments`;
";
        $sql .= "INSERT INTO `admin_users` (`account_id`, `name`, `email`, `password`, `status`, `created_at`) VALUES (NULL, 'Super Admin', 'admin@example.com', '" . addslashes(bcrypt('password')) . "', 'active', '" . now() . "');\n";
        $sql .= "INSERT INTO `admin_role_assignments` (`admin_user_id`, `role_id`) VALUES (1, 1);\n";
        $adminUserBatch = [];
        $roleAssignmentBatch = [];
        for ($i = 1; $i <= 9999; $i++) {
            $adminUserId = $i + 1; // Since Super Admin is id 1
            $adminUserBatch[] = [
                'account_id' => rand(1, 10000),
                'name' => addslashes($faker->name()),
                'email' => "admin{$i}@example.com",
                'password' => addslashes(bcrypt('password')),
                'status' => 'active',
                'created_at' => now(),
            ];
            $roleId = rand(0, 1) ? 1 : 3;
            $roleAssignmentBatch[] = [
                'admin_user_id' => $adminUserId,
                'role_id' => $roleId,
            ];
            if ($i % 10000 === 0) {
                foreach ($adminUserBatch as $idx => $user) {
                    $sql .= sprintf(
                        "INSERT INTO `admin_users` (`account_id`, `name`, `email`, `password`, `status`, `created_at`) VALUES (%d, '%s', '%s', '%s', '%s', '%s');\n",
                        $user['account_id'],
                        $user['name'],
                        $user['email'],
                        $user['password'],
                        $user['status'],
                        $user['created_at']
                    );
                    $sql .= sprintf(
                        "INSERT INTO `admin_role_assignments` (`admin_user_id`, `role_id`) VALUES (%d, %d);\n",
                        $roleAssignmentBatch[$idx]['admin_user_id'],
                        $roleAssignmentBatch[$idx]['role_id']
                    );
                }
                file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
                $adminUserBatch = [];
                $roleAssignmentBatch = [];
                $sql = "";
            }
        }
        if (!empty($adminUserBatch)) {
            foreach ($adminUserBatch as $idx => $user) {
                $sql .= sprintf(
                    "INSERT INTO `admin_users` (`account_id`, `name`, `email`, `password`, `status`, `created_at`) VALUES (%d, '%s', '%s', '%s', '%s', '%s');\n",
                    $user['account_id'],
                    $user['name'],
                    $user['email'],
                    $user['password'],
                    $user['status'],
                    $user['created_at']
                );
                $sql .= sprintf(
                    "INSERT INTO `admin_role_assignments` (`admin_user_id`, `role_id`) VALUES (%d, %d);\n",
                    $roleAssignmentBatch[$idx]['admin_user_id'],
                    $roleAssignmentBatch[$idx]['role_id']
                );
            }
            file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
        }
    }
}
