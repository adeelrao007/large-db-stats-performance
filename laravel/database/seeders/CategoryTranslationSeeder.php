<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        $sql = "TRUNCATE TABLE `category_translations`;
";
        foreach (range(1, 5) as $langId) {
            foreach (range(1, 100) as $catId) {
                $sql .= sprintf(
                    "INSERT INTO `category_translations` (`category_id`, `language_id`, `name`, `description`) VALUES (%d, %d, '%s', '%s');\n",
                    $catId,
                    $langId,
                    addslashes($faker->word()),
                    addslashes($faker->sentence())
                );
            }
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
