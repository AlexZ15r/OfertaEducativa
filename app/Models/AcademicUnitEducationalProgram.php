<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AcademicUnitEducationalProgram extends Pivot
{
    // props
    protected $table = 'public.academic_unit__educational_program';
    protected $fillable = [
        'academic_unit_id',
        'educational_program_id'
    ];
    public $timestamps = true;

    // relationships
    public function degreeTypes(): BelongsToMany
    {
        return $this->belongsToMany( DegreeTypes::class, 'formas_titulacion.academic_unit__educational_program__forma_titulacion', 'academic_unit__educational_program_id', 'id_forma_titulacion' )
                    ->using( AcademicUnitEducationalProgramDegreeType::class )
                    ->withPivot( ['id','fecha_aprobacion','acta','formato','activa','observaciones','modalidades'] )
                    ->withTimestamps();
    }
}
