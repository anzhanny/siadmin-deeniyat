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
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthdate')->nullable();
            $table->string('gender', 15)->nullable();
            $table->string('nis', 50)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('address', 100)->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->integer('is_active')->default(1);

            $table->string('father_name', 100)->nullable();
            $table->string('father_job', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('mother_job', 100)->nullable();
            $table->text('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
