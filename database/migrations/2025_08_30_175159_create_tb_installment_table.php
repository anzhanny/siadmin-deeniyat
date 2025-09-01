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
        Schema::create('tb_installment', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('payment_id');
            $table->string('nominal', 50);
            $table->string('installments_to', 15);
            $table->date('paid_at');
            $table->string('remaining_balance', 50);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_installment');
    }
};
