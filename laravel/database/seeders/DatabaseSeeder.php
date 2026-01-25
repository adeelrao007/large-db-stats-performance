<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminUserSeeder::class,
            AddressSeeder::class,
            CategoryTranslationSeeder::class,
            ProductTranslationSeeder::class,
            MessageSeeder::class,
            ProductReviewSeeder::class,
        ]);
    }
}
