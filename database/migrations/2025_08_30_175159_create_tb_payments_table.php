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
        Schema::create('tb_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 100)->nullable();
            $table->string('class_id', 20)->nullable();
            $table->string('installment_id', 25)->nullable();
            $table->enum('payment_method', ['full', 'installment']);
            $table->enum('payment_type', ['tunai', 'non-tunai']);
            $table->string('code', 50)->nullable();
            $table->decimal('amount', 12)->nullable();
            $table->enum('method', ['cash', 'transfer'])->nullable()->default('cash');
            $table->string('month', 20)->nullable();
            $table->string('year', 4)->nullable();
            $table->enum('status', ['pending', 'paid', 'failed'])->nullable()->default('pending');
            $table->date('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_payments');
    }
};
