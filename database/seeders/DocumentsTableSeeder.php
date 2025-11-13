<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('documents')->insert([
            'document_control_number' => 1001,
            'date_received' => Carbon::now()->subDays(3),
            'particular' => 'Request for Budget Allocation',
            'office_origin' => 'Finance Department',
            'user_id' => 1,
            'document_form' => 'Official Letter',
            'document_type' => 'Internal',
            'date_of_document' => Carbon::now()->subDays(5),
            'signatory' => 'John Doe',
            'date_forwarded' => Carbon::now()->subDays(2),
            'destination_office' => 'Accounting Office',
            'involved_office' => json_encode(['Finance Department', 'Accounting Office']),
            'action_taken' => 'Reviewed and forwarded to Accounting',
            'status' => 'Forwarded',
            'confidentiality' => 'Confidential',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
