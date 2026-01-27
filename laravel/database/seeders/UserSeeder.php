<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        $batch = [];
        $sql = "TRUNCATE TABLE `users`;
TRUNCATE TABLE `user_role_assignments`;
";
        for ($i = 1; $i <= 200000; $i++) {
            $batch[] = [
                'account_id' => rand(1, 10000),
                'language_id' => rand(1, 5),
                'region_id' => rand(1, 4),
                'name' => addslashes($faker->name()),
                'email' => "user{$i}@example.com",
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
            ];
            if ($i % 10000 === 0) {
                foreach ($batch as $user) {
                    $sql .= sprintf(
                        "INSERT INTO `users` (`account_id`, `language_id`, `region_id`, `name`, `email`, `email_verified_at`, `password`, `created_at`) VALUES (%d, %d, %d, '%s', '%s', '%s', '%s', '%s');\n",
                        $user['account_id'],
                        $user['language_id'],
                        $user['region_id'],
                        $user['name'],
                        $user['email'],
                        $user['email_verified_at'],
                        $user['password'],
                        $user['created_at']
                    );
                    $sql .= sprintf(
                        "INSERT INTO `user_role_assignments` (`user_id`, `role_id`) VALUES (LAST_INSERT_ID(), %d);\n",
                        rand(1, 3)
                    );
                }
                file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
                $batch = [];
                $sql = "";
            }
        }
        if (!empty($batch)) {
            foreach ($batch as $user) {
                $sql .= sprintf(
                    "INSERT INTO `users` (`account_id`, `language_id`, `region_id`, `name`, `email`, `email_verified_at`, `password`, `created_at`) VALUES (%d, %d, %d, '%s', '%s', '%s', '%s', '%s');\n",
                    $user['account_id'],
                    $user['language_id'],
                    $user['region_id'],
                    $user['name'],
                    $user['email'],
                    $user['email_verified_at'],
                    $user['password'],
                    $user['created_at']
                );
                $sql .= sprintf(
                    "INSERT INTO `user_role_assignments` (`user_id`, `role_id`) VALUES (LAST_INSERT_ID(), %d);\n",
                    rand(1, 3)
                );
            }
            file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
        }
    }
}
