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
        if ( Schema::hasTable('public.subjects') ) {
            Schema::table('public.subjects', function (Blueprint $table) {
                $table->foreign('area_id')->references('id')->on('public.areas')->nullOnDelete();
            } );
        } else {
            Schema::create('public.subjects', function (Blueprint $table) {
                $table->id();
                $table->string('key');
                $table->text('title');
                $table->text('purpose');
                $table->text('theoretical_hours');
                $table->text('practical_hours');
                $table->string('level');
                $table->string('credits');
                $table->boolean('is_approved');
                $table->string('type');
                $table->timestamp('approved_at');
                $table->string('teacher_identifier');
                $table->string('educational_program_year');
                $table->text('iw_hours');
                $table->bigInteger('area_id')->nullable();
                $table->string('subject_type')->nullable();
                $table->timestamps();

                $table->foreign('area_id')->references('id')->on('areas')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // eliminar tabla
        // Schema::dropIfExists('public.subjects');

        // eliminar las columnas creadas
        Schema::table('public.subjects', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
        });
    }
};
