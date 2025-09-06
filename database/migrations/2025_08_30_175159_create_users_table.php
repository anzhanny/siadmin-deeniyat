<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->string('name');
            $table->string('nis', 30)->unique(); // NIS otomatis
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();

            // Data pribadi
            $table->string('birthplace', 50)->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('father_job', 50)->nullable();
            $table->string('mother_job', 50)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('phone', 20)->nullable();

            // Data akademik
            $table->string('academic_year', 10)->nullable();
            $table->string('batch', 5)->nullable();

            // Status pembayaran dan aktif
            $table->boolean('is_active')->default(1);
            $table->boolean('is_paid')->default(false);
            $table->dateTime('paid_at')->nullable();

            // Foto
            $table->string('photo', 225)->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');

            // Index untuk percepat pencarian
            $table->index(['academic_year', 'batch', 'class_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
