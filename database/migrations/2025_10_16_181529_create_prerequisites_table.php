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
        Schema::create('public.prerequisites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('educational_program__subject_id');
            $table->bigInteger('prerequisite_id');
            $table->timestamps();

            $table->foreign('educational_program__subject_id')->references('id')->on('public.educational_program__subject');
            $table->foreign('prerequisite_id')->references('id')->on('public.subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.prerequisites');
    }
};
