<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();

        DB::table('users')->select('id')->chunk(1000, function ($users) use ($faker) {
            $batch = [];

            foreach ($users as $user) {
                $batch[] = [
                    'user_id' => $user->id,
                    'type' => 'shipping',
                    'address' => $faker->streetAddress(),
                    'city' => $faker->city(),
                    'country' => $faker->country(),
                ];
            }

            DB::table('addresses')->insert($batch);
        });
    }
}
