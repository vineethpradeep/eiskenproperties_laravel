<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Clean any non-numeric data (e.g. strings like '48sm') to avoid cast errors
        DB::statement("
            UPDATE properties
            SET property_size = NULL
            WHERE property_size !~ E'^[0-9]+$'
        ");

        // Step 2: Alter the column type from string to integer
        DB::statement("
            ALTER TABLE properties
            ALTER COLUMN property_size TYPE INTEGER
            USING property_size::INTEGER
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('property_size')->nullable()->change();
        });
    }
};
