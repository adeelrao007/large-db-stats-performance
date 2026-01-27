<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductReviewSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        $sql = "TRUNCATE TABLE `product_reviews`;
";
        for ($i = 1; $i <= 10000; $i++) {
            $sql .= sprintf(
                "INSERT INTO `product_reviews` (`product_id`, `user_id`, `rating`, `review`, `created_at`) VALUES (%d, %d, %d, '%s', '%s');\n",
                rand(1, 1000),
                rand(1, 200000),
                rand(1, 5),
                addslashes($faker->sentence()),
                now()
            );
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
