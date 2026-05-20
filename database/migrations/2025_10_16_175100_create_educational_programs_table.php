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
        if ( Schema::hasTable('public.educational_programs') ) {
            Schema::table('public.educational_programs', function (Blueprint $table) {
                $table->dropColumn('modality');
                $table->string('_key')->nullable();
                $table->string('__key')->nullable();
                $table->string('type')->nullable();
                $table->boolean('active')->nullable();
                $table->boolean('with_terminals')->nullable();
                $table->timestamps();
            } );
        } else {
            Schema::create('public.educational_programs', function (Blueprint $table) {
                $table->id();
                $table->string('type');
                $table->string('key');
                $table->string('_key');
                $table->string('__key');
                $table->string('name');
                $table->boolean('active');
                $table->boolean('with_terminals');
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
        // Schema::dropIfExists('public.educational_programs');

        // eliminar las columnas creadas
        Schema::table('public.educational_programs', function (Blueprint $table) {
            $table->string('modality');
            $table->dropColumn('type');
            $table->dropColumn('_key');
            $table->dropColumn('__key');
            $table->dropColumn('active');
            $table->dropColumn('with_terminals');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        } );
    }
};
