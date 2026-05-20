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
        if ( Schema::hasTable('info') ) {
            Schema::table('info', function (Blueprint $table) {
                $table->string('vigencia');
            });
        } else {
            Schema::create('info', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('educational_program_id');
                $table->string('nivel_educativo');
                $table->string('tipo');
                $table->integer('duracion');
                $table->string('tipo_duracion');
                $table->string('descripcion_duracion');
                $table->string('horas_min_max');
                $table->string('creditos_min_max');
                $table->string('tiempo_min_max');
                $table->string('titulo_otorgado');
                $table->string('certificado_otorgado');
                $table->string('periodicidad');
                $table->integer('duracion_basico');
                $table->integer('duracion_formativo');
                $table->string('vigencia');
                $table->timestamps();

                $table->foreign('educational_program_id')->references('id')->on('public.educational_programs');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('info', function (Blueprint $table) {
            $table->dropColumn('vigencia');
        });
    }
};
