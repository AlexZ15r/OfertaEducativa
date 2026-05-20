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
        Schema::create('lic__area_principal', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_oferta');
            $table->bigInteger('id_area_principal');
            $table->timestamps();

            $table->foreign('id_oferta')->references('id')->on('public.campus__academic_unit__educational_program');
            $table->foreign('id_area_principal')->references('id')->on('areas_principales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lic__area_principal');
    }
};
