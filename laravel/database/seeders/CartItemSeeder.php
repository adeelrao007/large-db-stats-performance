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
        // Truncate cart_items table for a clean slate
        DB::table('cart_items')->truncate();

        // Assign random products to each cart without loading all product IDs into memory
        $faker = \Faker\Factory::create();

        // Process carts in chunks to avoid memory issues
        DB::table('carts')->orderBy('id')->chunk(10000, function ($carts) use ($faker) {
            $batch = [];
            foreach ($carts as $cart) {
                // Assign 1-5 random products to each cart
                $numProducts = rand(1, 5);
                $selectedProducts = DB::table('products')
                    ->inRandomOrder()
                    ->limit($numProducts)
                    ->pluck('id');
                foreach ($selectedProducts as $productId) {
                    $batch[] = [
                        'cart_id' => $cart->id,
                        'product_id' => $productId,
                        'quantity' => rand(1, 3),
                        'price' => $faker->randomFloat(2, 10, 500),
                    ];
                }
            }
            // Insert in batch for performance
            if (!empty($batch)) {
                DB::table('cart_items')->insert($batch);
            }
        });
    }
}
