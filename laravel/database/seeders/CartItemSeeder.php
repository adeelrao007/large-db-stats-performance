<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartItem;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example: Add a cart item for cart_id 1 and product_id 1
        CartItem::create([
            'cart_id' => 1,
            'product_id' => 1,
            'quantity' => 2,
            'price' => 100.00,
        ]);
        // Add more cart items as needed
    }
}
