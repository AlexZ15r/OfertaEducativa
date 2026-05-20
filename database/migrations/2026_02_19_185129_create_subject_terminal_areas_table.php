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
        Schema::create('public.subject__terminal_area', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('terminal_area_id');
            $table->decimal('semester');
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('public.subjects');
            $table->foreign('terminal_area_id')->references('id')->on('public.terminal_areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.subject__terminal_area');
    }
};
