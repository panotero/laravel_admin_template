<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'office_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('office_id')
                    ->nullable()
                    ->default(0)
                    ->after('role_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {});
    }
};
