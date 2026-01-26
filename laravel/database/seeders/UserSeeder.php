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
        DB::table('users')->truncate();
        DB::table('user_role_assignments')->truncate();

        for ($i = 1; $i <= 200000; $i++) {
            $batch[] = [
                'account_id' => rand(1, 10000),
                'language_id' => rand(1, 5),
                'region_id' => rand(1, 4),
                'name' => $faker->name(),
                'email' => "user{$i}@example.com",
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
            ];

            if ($i % 10000 === 0) {
                DB::table('users')->insert($batch);
                // Assign a random role 2 to each user in this batch
                $userIds = DB::table('users')->orderBy('id', 'desc')->limit(10000)->pluck('id');
                $roleAssignments = [];
                foreach ($userIds as $userId) {
                    $roleAssignments[] = [
                        'user_id' => $userId,
                        'role_id' => 2,
                    ];
                }
                DB::table('user_role_assignments')->insert($roleAssignments);
                $batch = [];
            }
        }
        // Insert any remaining users and assign roles
        if (!empty($batch)) {
            DB::table('users')->insert($batch);
            $userIds = DB::table('users')->orderBy('id', 'desc')->limit(count($batch))->pluck('id');
            $roleAssignments = [];
            foreach ($userIds as $userId) {
                $roleAssignments[] = [
                    'user_id' => $userId,
                    'role_id' => rand(1, 3),
                ];
            }
            DB::table('user_role_assignments')->insert($roleAssignments);
        }
    }
}
