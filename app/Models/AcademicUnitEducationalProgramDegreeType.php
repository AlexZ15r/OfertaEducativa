<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class AcademicUnitEducationalProgramDegreeType extends Pivot
{
    // props
    protected $table = 'formas_titulacion.academic_unit__educational_program__forma_titulacion';
    protected $fillable = [
        'academic_unit__educational_program_id',
        'id_forma_titulacion',
        'fecha_aprobacion',
        'acta',
        'formato',
        'activa',
        'observaciones',
        'modalidades'
    ];
    public $timestamps = true;

    // accessors
    protected function fechaAprobacion(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => Str::substr($value, 0, 10)
        );
    }
}
