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
        if ( Schema::hasTable('public.academic_unit__subject') ) {
        } else {
            Schema::create('public.academic_unit__subject', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('academic_unit_id');
                $table->bigInteger('subject_id');

                $table->foreign('academic_unit_id')->references('id')->on('public.academic_units');
                $table->foreign('subject_id')->references('id')->on('public.subjects');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('public.academic_unit__subject');
    }
};
