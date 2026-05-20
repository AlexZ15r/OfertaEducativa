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
        if ( Schema::hasTable('public.academic_unit__educational_program') ) {
            Schema::table('public.academic_unit__educational_program', function (Blueprint $table) {
                $table->timestamps();
            } );
        } else {
            Schema::create('public.academic_unit__educational_program', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('academic_unit_id');
                $table->bigInteger('educational_program_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // eliminar tabla
        // Schema::dropIfExists('public.academic_unit__educational_program');

        // eliminar las columnas creadas
        Schema::table('public.academic_unit__educational_program', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
};
