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
        Schema::create('userconfig_table', function (Blueprint $table) {
            $table->increments('id'); // Primary Key
            $table->string('designation', 100);
            $table->enum('approval_type', ['pre-approval', 'final-approval', 'routing']);
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userconfig_table');
    }
};
