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
            $table->unsignedInteger('payment_id')->after('id');
            $table->foreign('payment_id')->references('id')->on('tb_payments')->onDelete('cascade');
            $table->decimal('nominal', 12, 2);
            $table->string('installments_to');
            $table->date('paid_at')->nullable();
            $table->string('remaining_balance', 12, 2)->nullable();
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
