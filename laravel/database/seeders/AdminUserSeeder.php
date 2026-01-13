<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();

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

        for ($i = 1; $i <= 9999; $i++) {
            DB::table('admin_users')->insert([
                'account_id' => rand(1, 10000),
                'name' => $faker->name(),
                'email' => "admin{$i}@example.com",
                'password' => bcrypt('password'),
                'status' => 'active',
                'created_at' => now(),
            ]);
        }
    }
}
