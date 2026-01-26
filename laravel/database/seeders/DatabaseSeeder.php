<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command?->getOutput()->writeln('<info>Disabling foreign key checks...</info>');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $seeders = [
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            AdminUserSeeder::class,
            AddressSeeder::class,
            CategoryTranslationSeeder::class,
            ProductTranslationSeeder::class,
            MessageSeeder::class,
            ProductReviewSeeder::class,
            CartItemSeeder::class,
        ];

        $bar = $this->command?->getOutput()->createProgressBar(count($seeders));
        $bar?->start();

        foreach ($seeders as $seeder) {
            $this->command?->getOutput()->writeln("\n<comment>Starting: $seeder</comment>");
            $this->call($seeder);
            $this->command?->getOutput()->writeln("<info>Completed: $seeder</info>");
            $bar?->advance();
        }
        $bar?->finish();
        $this->command?->getOutput()->writeln("\n<info>All seeders completed.</info>");

        $this->command?->getOutput()->writeln('<info>Enabling foreign key checks...</info>');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
