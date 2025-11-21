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
        Schema::create('approval_table', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('document_id'); // FK reference (int)
            $table->unsignedBigInteger('user_id');     // FK reference (int)

            $table->string('approval_type', 100);      // Not nullable
            $table->string('remarks', 1000)->nullable(); // Nullable

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_table');
    }
};
