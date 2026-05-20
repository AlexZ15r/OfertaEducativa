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
        Schema::table('public.subject__terminal_area', function (Blueprint $table) {
            $table->bigInteger('area_id')->nullable();

            $table->foreign('area_id')->references('id')->on('public.areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public.subject__terminal_area', function (Blueprint $table) {
            $table->dropColumn('area_id');
        });
    }
};
