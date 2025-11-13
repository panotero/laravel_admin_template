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
        Schema::create('modifications', function (Blueprint $table) {
            $table->id('modification_id');
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('modified_by');
            $table->string('modification_type', 50);
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamp('modified_at')->useCurrent();

            $table->foreign('document_id')->references('document_id')->on('documents')->onDelete('cascade');
            $table->foreign('modified_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modifications');
    }
};
