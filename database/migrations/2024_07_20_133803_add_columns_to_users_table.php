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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_phone')->after('email')->nullable();
            $table->unsignedBigInteger('business_unit_id')->after('mobile_phone')->nullable();
            $table->unsignedBigInteger('area_id')->after('business_unit_id')->nullable();
            $table->unsignedBigInteger('division_id')->after('area_id')->nullable();
            $table->unsignedBigInteger('job_level_id')->after('division_id')->nullable();
            $table->unsignedBigInteger('job_position_id')->after('job_level_id')->nullable();
            $table->unsignedBigInteger('approval_id')->after('job_position_id')->nullable();

            // Add foreign key constraints
            $table->foreign('business_unit_id')->references('id')->on('business_units')->onDelete('set null');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
            $table->foreign('job_level_id')->references('id')->on('job_levels')->onDelete('set null');
            $table->foreign('job_position_id')->references('id')->on('job_positions')->onDelete('set null');
            $table->foreign('approval_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mobile_phone',
                'business_unit_id',
                'area_id',
                'division_id',
                'job_level_id',
                'job_position_id',
                'approval_id',
            ]);
        });
    }
};
