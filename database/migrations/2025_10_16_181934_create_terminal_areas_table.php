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
        Schema::create('public.terminal_areas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('educational_program_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('educational_program_id')->references('id')->on('public.educational_programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.terminal_areas');
    }
};
