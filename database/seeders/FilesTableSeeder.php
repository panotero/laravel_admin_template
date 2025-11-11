<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('files')->insert([
            'document_id' => 1,
            'file_path' => 'uploads/documents/doc_1001.pdf',
            'file_password' => bcrypt('secret123'),
            'uploading_office' => 'Finance Department',
            'uploaded_by' => 1,
            'uploaded_at' => Carbon::now()
        ]);
    }
}
