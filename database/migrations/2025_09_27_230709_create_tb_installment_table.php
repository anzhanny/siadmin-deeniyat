<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_installment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('nominal'); // total cicilan (misal 450000)
            $table->integer('remaining_balance')->nullable(); // sisa hutang
            $table->date('due_date')->nullable(); // jatuh tempo global
            $table->enum('status', ['pending','partial','paid'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_installment');
    }
};
