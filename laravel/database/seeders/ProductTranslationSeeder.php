<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();

        foreach (range(1, 5) as $langId) {
            DB::table('products')->select('id')->chunk(1000, function ($products) use ($faker, $langId) {
                $batch = [];

                foreach ($products as $product) {
                    $batch[] = [
                        'product_id' => $product->id,
                        'language_id' => $langId,
                        'name' => $faker->productName(),
                        'description' => $faker->paragraph(),
                    ];
                }

                DB::table('product_translations')->insert($batch);
            });
        }
    }
}
