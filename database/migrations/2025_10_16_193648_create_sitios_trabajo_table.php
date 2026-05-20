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
        Schema::create('sitios_trabajo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_campo_laboral');
            $table->text('sitio');
            $table->timestamps();

            $table->foreign('id_campo_laboral')->references('id')->on('campo_laboral');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sitios_trabajo');
    }
};
