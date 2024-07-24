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
        Schema::create('submission_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('qty_submission');
            $table->integer('qty_remaining')->nullable();
            $table->integer('qty_approved')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_details');
    }
};
