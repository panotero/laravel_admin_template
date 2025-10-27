<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('themes')->insert([
            'logo' => 'logo.png',
            'primary_color' => '#1d4ed8',
            'secondary_color' => '#64748b',
            'highlight_color' => '#f59e0b',
            'accent_color' => '#10b981',
        ]);
    }
}
