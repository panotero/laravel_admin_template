<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Setting_roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting_role')->upsert(
            [
                ['id' => 1, 'role_name' => 'superadmin'],
                ['id' => 2, 'role_name' => 'admin'],
                ['id' => 3, 'role_name' => 'user'],
                ['id' => 4, 'role_name' => 'developer'],
            ],
            ['role_name'], // unique key to check
            ['role_name']  // columns to update if exists
        );
    }
}
