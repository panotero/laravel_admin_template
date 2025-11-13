<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('modifications')->insert([
            'document_id' => 1,
            'modified_by' => 1,
            'modification_type' => 'Edit',
            'old_value' => json_encode(['status' => 'Pending']),
            'new_value' => json_encode(['status' => 'Forwarded']),
            'modified_at' => Carbon::now()
        ]);
    }
}
