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
        Schema::create('public.electives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subject_id');
            $table->bigInteger('elective_id');
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('public.subjects');
            $table->foreign('elective_id')->references('id')->on('public.subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.electives');
    }
};
