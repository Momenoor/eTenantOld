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

        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 8, 2);
            $table->string('number')->nullable();
            $table->date('date');
            $table->string('bank_name')->default('cash');
            $table->text('narration')->nullable();
            $table->foreignId('contract_id')->constrained();
            $table->foreignId('status_id')->constrained('types')->comment('0=>unpaid,1=>paid,2=>partial,3=>returned,4=>cancelled,5=>hold');
            $table->foreignId('type_id')->constrained()->comment('0=>cash,1=>check,2=>bank_transfer');
            $table->foreignId('category_id')->constrained('types')->comment('0=>installment,1=>security_deposit,2=>vat');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
