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
        Schema::create('coordenadas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_oferta');
            $table->string('latitud');
            $table->string('longitud');
            $table->timestamps();

            $table->foreign('id_oferta')->references('id')->on('public.campus__academic_unit__educational_program');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordenadas');
    }
};
