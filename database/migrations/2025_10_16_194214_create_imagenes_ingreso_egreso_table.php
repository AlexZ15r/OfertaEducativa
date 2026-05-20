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
        Schema::create('imagenes_ingreso_egreso', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('educational_program_id');
            $table->string('ingreso');
            $table->string('egreso');
            $table->timestamps();

            $table->foreign('educational_program_id')->references('id')->on('public.educational_programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_ingreso_egreso');
    }
};
