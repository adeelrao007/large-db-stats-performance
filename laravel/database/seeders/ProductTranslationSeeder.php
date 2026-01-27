<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        $sql = "TRUNCATE TABLE `product_translations`;
";
        foreach (range(1, 5) as $langId) {
            foreach (range(1, 1000) as $productId) {
                $sql .= sprintf(
                    "INSERT INTO `product_translations` (`product_id`, `language_id`, `name`, `description`) VALUES (%d, %d, '%s', '%s');\n",
                    $productId,
                    $langId,
                    addslashes($faker->word()),
                    addslashes($faker->sentence())
                );
            }
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
