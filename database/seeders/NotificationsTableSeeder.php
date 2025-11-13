<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('notifications')->insert([
            'document_id' => 1,
            'user_id' => 1,
            'message' => 'Document #1001 has been forwarded to Accounting Office.',
            'is_read' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
