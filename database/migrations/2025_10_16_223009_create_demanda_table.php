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
        Schema::create('demanda', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_lic__modalidad');
            $table->string('demanda');
            $table->string('cpp');
            $table->timestamps();

            $table->foreign('id_lic__modalidad')->references('id')->on('lic__modalidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demanda');
    }
};
