<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdmissionGraduationImages extends Model
{
    // props
    protected $table = 'imagenes_ingreso_egreso';
    protected $fillable = [
        'educational_program_id',
        'ingreso',
        'egreso'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo( EducationalProgram::class, 'educational_program_id', 'id' );
    }
}
