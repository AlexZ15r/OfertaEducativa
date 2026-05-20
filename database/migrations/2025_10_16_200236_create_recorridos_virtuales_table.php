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
        Schema::create('recorridos_virtuales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_oferta');
            $table->text('url');
            $table->timestamps();

            $table->foreign('id_oferta')->references('id')->on('public.campus__academic_unit__educational_program');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recorridos_virtuales');
    }
};
