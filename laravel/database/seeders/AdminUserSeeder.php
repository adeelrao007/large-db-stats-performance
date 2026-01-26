<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        DB::table('admin_users')->truncate();
        DB::table('admin_role_assignments')->truncate();

        DB::table('admin_users')->insert([
            [
                'account_id' => null,
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'status' => 'active',
                'created_at' => now(),
            ],
        ]);

        // Assign only Admin (1) role to Super Admin (id = 1)
        DB::table('admin_role_assignments')->insert([
            ['admin_user_id' => 1, 'role_id' => 1],
        ]);

        $adminUserBatch = [];
        $roleAssignmentBatch = [];
        for ($i = 1; $i <= 9999; $i++) {
            $adminUserId = $i + 1; // Since Super Admin is id 1
            $adminUserBatch[] = [
                'account_id' => rand(1, 10000),
                'name' => $faker->name(),
                'email' => "admin{$i}@example.com",
                'password' => bcrypt('password'),
                'status' => 'active',
                'created_at' => now(),
            ];
            // Randomly assign either Admin (1) or Manager (3) role to each admin user
            $roleId = rand(0, 1) ? 1 : 3;
            $roleAssignmentBatch[] = [
                'admin_user_id' => $adminUserId,
                'role_id' => $roleId,
            ];
            if ($i % 10000 === 0) {
                DB::table('admin_users')->insert($adminUserBatch);
                DB::table('admin_role_assignments')->insert($roleAssignmentBatch);
                $adminUserBatch = [];
                $roleAssignmentBatch = [];
            }
        }
        // Insert any remaining users and assignments
        if (!empty($adminUserBatch)) {
            DB::table('admin_users')->insert($adminUserBatch);
            DB::table('admin_role_assignments')->insert($roleAssignmentBatch);
        }
    }
}
