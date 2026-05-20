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
        Schema::create('public.precedents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('educational_program__subject_id');
            $table->bigInteger('precedent_id');
            $table->timestamps();

            $table->foreign('educational_program__subject_id')->references('id')->on('public.educational_program__subject');
            $table->foreign('precedent_id')->references('id')->on('public.subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.precedents');
    }
};
