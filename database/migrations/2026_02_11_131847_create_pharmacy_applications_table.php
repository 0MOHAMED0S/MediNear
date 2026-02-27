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
        Schema::create('pharmacy_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('user_id');

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
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_applications');
    }
};
