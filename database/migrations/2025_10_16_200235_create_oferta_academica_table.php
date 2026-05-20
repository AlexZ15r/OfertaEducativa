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
        Schema::create('public.campus__academic_unit__educational_program', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campus_id');
            $table->bigInteger('academic_unit_id');
            $table->bigInteger('educational_program_id');
            $table->boolean('origin');
            $table->boolean('active');
            $table->timestamps();


            $table->foreign('campus_id')->references('id')->on('public.campus');
            $table->foreign('academic_unit_id')->references('id')->on('public.academic_units');
            $table->foreign('educational_program_id')->references('id')->on('public.educational_programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.campus__academic_unit__educational_program');
    }
};
