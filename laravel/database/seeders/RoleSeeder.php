<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'User', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'Manager', 'guard_name' => 'web'],
        ]);
    }
}
