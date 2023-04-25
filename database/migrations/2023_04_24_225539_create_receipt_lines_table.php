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

        Schema::create('receipt_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reciept_id')->constrained();
            $table->foreignId('installment_id')->constrained();
            $table->decimal('amount', 8, 2);
            $table->text('narration')->nullable();
            $table->date('received_at');
            $table->foreignId('type_id')->constrained()->comment('bank,cash');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_lines');
    }
};
