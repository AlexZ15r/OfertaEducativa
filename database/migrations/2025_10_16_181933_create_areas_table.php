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
        if ( Schema::hasTable('public.areas') ) {
            Schema::table('public.areas', function (Blueprint $table) {
                $table->dropForeign(['parent_id']);
                $table->dropColumn('parent_id');
                $table->string('color')->nullable();
            });
        } else {
            Schema::create('public.areas', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('color');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop table
        // Schema::dropIfExists('public.areas');

        // restore status
        Schema::table('public.areas', function (Blueprint $table) {
            $table->bigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('public.areas');
            $table->dropColumn('color');
        });
    }
};
