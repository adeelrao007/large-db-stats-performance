<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        // Example: Generate 1000 addresses
        $faker = \Faker\Factory::create();
        $sql = "TRUNCATE TABLE `addresses`;
";
        for ($i = 1; $i <= 1000; $i++) {
            $sql .= sprintf(
                "INSERT INTO `addresses` (`user_id`, `region_id`, `address_line1`, `city`, `postal_code`, `created_at`) VALUES (%d, %d, '%s', '%s', '%s', '%s');\n",
                rand(1, 200000),
                rand(1, 4),
                addslashes($faker->streetAddress),
                addslashes($faker->city),
                addslashes($faker->postcode),
                now()
            );
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
