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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('primary_color')->default('#1d4ed8');
            $table->string('secondary_color')->default('#64748b');
            $table->string('highlight_color')->default('#f59e0b');
            $table->string('accent_color')->default('#10b981');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
