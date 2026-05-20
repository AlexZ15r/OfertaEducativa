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
        Schema::create('areas_principales', function (Blueprint $table) {
            $table->id();
            $table->integer('aparicion');
            $table->string('nombre');
            $table->string('color_titulo', 50);
            $table->string('color_fondo_high', 50);
            $table->string('color_fondo_low', 50);
            $table->string('color_borde', 50);
            $table->string('class');
            $table->string('img');
            $table->string('icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas_principales');
    }
};
