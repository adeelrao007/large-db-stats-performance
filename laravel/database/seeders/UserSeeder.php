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

            if ($i % 1000 === 0) {
                DB::table('users')->insert($batch);
                $batch = [];
            }
        }
    }
}
