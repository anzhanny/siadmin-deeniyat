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
        Schema::create('tb_class', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_name', 100);
            $table->unsignedInteger('amount')->nullable()->default(0);
            $table->string('teacher_name', 50);
            $table->year('academic_year_first');
            $table->year('academic_year_last');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_class');
    }
};
