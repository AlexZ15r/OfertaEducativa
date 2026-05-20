<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DegreeTypes extends Model
{
    // props
    protected $table = 'formas_titulacion.formas_titulacion';
    protected $fillable = [
        'nombre',
        'reglamentaria'
    ];
    public $timestamps = true;

    // relationships
    public function educationalPrograms(): BelongsToMany
    {
        return $this->belongsToMany( AcademicUnitEducationalProgram::class, 'public.academic_unit__educational_program__forma_titulacion', 'academic_unit__educational_program_id', 'id_forma_titulacion' )
                    ->using( AcademicUnitEducationalProgramDegreeType::class )
                    ->withPivot( ['fecha_aprobacion','acta','formato','activa','observaciones'] )
                    ->withTimestamps();
    }
}
