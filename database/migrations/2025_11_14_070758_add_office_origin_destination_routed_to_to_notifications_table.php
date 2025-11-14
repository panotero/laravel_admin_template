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
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('office_origin')->nullable()->after('id');
            $table->string('destination_office')->nullable()->after('office_origin');
            $table->integer('routed_to')->nullable()->after('destination_office');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['office_origin', 'destination_office', 'routed_to']);
        });
    }
};
