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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Assuming 'users' table
            $table->dateTime('date');
            $table->double('total_cost');
            $table->integer('status_po')->nullable();
            $table->string('po_number')->nullable();
            $table->integer('status_client')->default(0);
            $table->foreignId('submission_category_id')->constrained('submission_categories'); // Assuming 'request_types' table
            $table->string('request_file_1')->nullable();
            $table->string('request_file_2')->nullable();
            $table->string('notes')->nullable();
            $table->string('user_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
