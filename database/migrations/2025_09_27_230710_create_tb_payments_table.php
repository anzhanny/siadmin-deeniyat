<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_payments', function (Blueprint $table) {
            $table->id();

            // relasi ke installment (nullable kalau pembayaran langsung lunas tanpa cicilan)
            $table->foreignId('installment_id')->nullable()->constrained('tb_installment')->onDelete('cascade');

            // relasi ke user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // relasi ke kelas
            $table->unsignedInteger('class_id')->nullable();
            $table->foreign('class_id')
                ->references('id')
                ->on('tb_class')
                ->onDelete('set null');

            $table->enum('payment_for', ['register', 'spp']);   // jenis pembayaran
            $table->enum('payment_category', ['lunas', 'cicilan']); // kategori
            $table->enum('payment_type', ['tunai', 'non-tunai']);   // tunai / transfer

            $table->string('code', 50)->nullable(); // kode unik
            $table->decimal('amount', 12, 2)->nullable(); // nominal per pembayaran
            $table->string('method', 255)->nullable(); // misal midtrans, manual
            $table->string('month', 20)->nullable();   // untuk SPP
            $table->string('year', 4)->nullable();     // untuk SPP

            $table->enum('status', ['pending', 'paid', 'failed', 'overdue'])->default('pending');
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_payments');
    }
};
