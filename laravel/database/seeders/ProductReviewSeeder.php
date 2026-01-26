<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductReviewSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        DB::table('product_reviews')->truncate();

        DB::table('orders')->select('user_id')->chunk(10000, function ($orders) use ($faker) {
            $batch = [];

            foreach ($orders as $order) {
                if (rand(0, 1)) {
                    $batch[] = [
                        'product_id' => rand(1, 500000),
                        'user_id' => $order->user_id,
                        'rating' => rand(3, 5),
                        'comment' => $faker->sentence(),
                        'created_at' => now(),
                    ];
                }
            }

            if ($batch) {
                DB::table('product_reviews')->insert($batch);
            }
        });
    }
}
