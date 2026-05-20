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
        if ( Schema::hasTable('public.academic_units') ) {
            Schema::table('public.academic_units', function (Blueprint $table) {
                $table->string('_key')->nullable();
                $table->timestamps();
            } );
        } else {
            Schema::create('public.academic_units', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('key');
                $table->string('_key');
                $table->string('type');
                $table->timestamps();
            } );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // eliminar tabla
        // Schema::dropIfExists('public.academic_units');

        // eliminar las columnas creadas
        Schema::table('public.academic_units', function (Blueprint $table) {
            $table->dropColumn('_key');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        } );
    }
};
