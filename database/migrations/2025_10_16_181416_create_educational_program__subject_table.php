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
        if ( Schema::hasTable('public.educational_program__subject') ) {
            Schema::table('public.educational_program__subject', function (Blueprint $table) {
                $table->text('semester')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::create('public.educational_program__subject', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('educational_program_id');
                $table->bigInteger('subject_id');
                $table->text('semester')->nullable();
                $table->bigInteger('area_id');
                $table->timestamps();

                $table->foreign('educational_program_id')->references('id')->on('public.educational_programs');
                $table->foreign('subject_id')->references('id')->on('public.subjects');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public.educational_program__subject', function (Blueprint $table) {
            $table->dropColumn('semester');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
};
