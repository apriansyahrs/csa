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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();
            $table->string('name');
            $table->foreignId('item_category_id')->constrained('item_categories')->onDelete('cascade');
            $table->foreignId('item_unit_type_id')->constrained('item_unit_types')->onDelete('cascade');
            $table->double('price')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('stock')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
