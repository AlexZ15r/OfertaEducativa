<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    // props
    protected $table = 'perfiles';
    protected $fillable = [
        'educational_program_id',
        'perfil_ingreso',
        'perfil_egreso'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo( EducationalProgram::class, 'educational_program_id', 'id' );
    }
}
