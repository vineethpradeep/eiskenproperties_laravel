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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('ptype_id');
            $table->string('amenities_id');
            $table->string('property_category');
            $table->string('property_name');
            $table->string('property_slug');
            $table->string('property_code');
            $table->string('property_status');
            $table->string('furnishing');
            $table->string('deposit')->nullable();
            $table->unsignedInteger('rent')->nullable();
            $table->string('property_thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('floors')->nullable();
            $table->string('condition')->nullable();
            $table->string('availabilityDate')->nullable();
            $table->string('epc')->nullable();
            $table->string('council_band')->nullable();
            $table->string('property_size')->nullable();
            $table->string('property_year')->nullable();
            $table->string('property_video')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('school_distance')->nullable();
            $table->string('bus_distance')->nullable();
            $table->string('station_distance')->nullable();
            $table->string('featured')->nullable();
            $table->string('hot')->nullable();
            $table->integer('agent_id')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
