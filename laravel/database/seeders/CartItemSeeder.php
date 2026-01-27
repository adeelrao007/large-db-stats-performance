<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $sql = "TRUNCATE TABLE `cart_items`;
";
        // For demonstration, generate 10000 cart items
        for ($i = 1; $i <= 10000; $i++) {
            $sql .= sprintf(
                "INSERT INTO `cart_items` (`cart_id`, `product_id`, `quantity`, `price`) VALUES (%d, %d, %d, %.2f);\n",
                rand(1, 299625),
                rand(1, 498576),
                rand(1, 3),
                $faker->randomFloat(2, 10, 500)
            );
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
