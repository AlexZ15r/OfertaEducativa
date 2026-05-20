<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\RequestMatcher\SchemeRequestMatcher;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if ( Schema::hasTable('public.area__educational_program') ) {
            Schema::table('public.area__educational_program', function (Blueprint $table) {
                $table->timestamps();
            });
        } else {
            Schema::create('public.area__educational_program', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('area_id');
                $table->bigInteger('educational_program_id');
                $table->timestamps();

                $table->foreign('area_id')->references('id')->on('public.areas');
                $table->foreign('educational_program_id')->references('id')->on('public.educational_programs');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop table
        // Schema::drop('public.area__educational_program');

        // drop columns
        Schema::table('public.area__educational_program', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
};
