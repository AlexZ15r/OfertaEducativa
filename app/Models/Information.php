<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Information extends Model
{
    // props
    protected $table = 'info';
    protected $fillable = [
        'educational_program_id',
        'nivel_educativo',
        'tipo',
        'duracion',
        'tipo_duracion',
        'descripcion_duracion',
        'horas_min_max',
        'creditos_min_max',
        'tiempo_min_max',
        'titulo_otorgado',
        'certificado_otorgado',
        'periodicidad',
        'duracion_basico',
        'duracion_formativo',
        'vigencia'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo( EducationalProgram::class, 'educational_program_id', 'id' );
    }
}
