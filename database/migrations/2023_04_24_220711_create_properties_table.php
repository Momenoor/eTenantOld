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
        Schema::disableForeignKeyConstraints();

        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('floor_count')->nullable();
            $table->string('makani')->nullable();
            $table->string('premises')->nullable();
            $table->string('condition')->nullable();
            $table->text('address')->nullable();
            $table->enum('emirate', ["abu"]);
            $table->string('description')->nullable();
            $table->foreignId('type_id')->constrained();
            $table->foreignId('landlord_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
