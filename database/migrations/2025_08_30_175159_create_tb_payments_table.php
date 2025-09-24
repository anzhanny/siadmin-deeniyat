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
            // Relasi ke users
    $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

    // Relasi ke kelas (optional, kalau kamu pakai foreign key)
    $table->unsignedBigInteger('class_id')->nullable();
    $table->foreign('class_id')->references('id')->on('tb_class')->onDelete('set null');
    
            $table->enum('payment_for', ['register', 'spp']);
            $table->enum('payment_category', ['lunas', 'cicilan']);
            $table->enum('payment_type', ['tunai', 'non-tunai']);
            $table->string('code', 50)->nullable();
            $table->decimal('amount', 12)->nullable();
            $table->string('method',255)->nullable();
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
