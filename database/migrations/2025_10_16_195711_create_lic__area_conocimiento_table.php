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
        Schema::create('lic__area_conocimiento', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('educational_program_id');
            $table->bigInteger('id_area_conocimiento');
            $table->timestamps();

            $table->foreign('educational_program_id')->references('id')->on('public.educational_programs');
            $table->foreign('id_area_conocimiento')->references('id')->on('areas_conocimiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lic__area_conocimiento');
    }
};
