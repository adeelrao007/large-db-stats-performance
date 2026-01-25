<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        DB::table('category_translations')->truncate();

        foreach (range(1, 5) as $langId) {
            DB::table('categories')->select('id')->chunk(1000, function ($cats) use ($faker, $langId) {
                $batch = [];

                foreach ($cats as $cat) {
                    $batch[] = [
                        'category_id' => $cat->id,
                        'language_id' => $langId,
                        'name' => ucfirst($faker->word()),
                    ];
                }

                DB::table('category_translations')->insert($batch);
            });
        }
    }
}
