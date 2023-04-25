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

        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('property_id')->constrained();
            $table->foreignId('type_id')->constrained()->comment('0=>active,1=>expired,2=>terminated,3=>renewed,4=>pending');
            $table->foreignId('status_id')->constrained('types')->comment('0=>active,1=>expired,2=>terminated,3=>renewed,4=>pending');
            $table->date('start_at');
            $table->date('expire_at');
            $table->date('grace_start_at');
            $table->date('grace_expire_at');
            $table->decimal('annual_value', 8, 2);
            $table->decimal('value', 8, 2);
            $table->string('discount')->nullable();
            $table->string('atesting_document_number');
            $table->text('remarks')->nullable();
            $table->text('conditions')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
