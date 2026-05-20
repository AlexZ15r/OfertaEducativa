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
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_oferta');
            $table->string('imagen');
            $table->boolean('catalogo_principal');
            $table->boolean('catalogo_licenciatura');
            $table->timestamps();

            $table->foreign('id_oferta')->references('id')->on('public.campus__academic_unit__educational_program');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
