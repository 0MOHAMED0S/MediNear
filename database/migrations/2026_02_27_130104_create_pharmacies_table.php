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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_application_id')->constrained()->onDelete('cascade');
            $table->string('pharmacy_name');
            $table->string('owner_name');
            $table->string('phone_number');
            $table->string('address');
            //location
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);    
            $table->string('license_number');
            $table->string('license_image');
            $table->string('commercial_number')->unique();
            $table->string('national_id_number');
            $table->date('expiration_date');
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->boolean('is_24_hours')->default(false);
            $table->boolean('is_delivery')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
