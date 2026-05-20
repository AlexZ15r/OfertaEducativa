<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmploymentArea extends Model
{
    // props
    protected $table = 'campo_laboral';
    protected $fillable = [
        'educational_program_id',
        'campo_laboral'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo( EducationalProgram::class, 'educational_program_id', 'id' );
    }
    public function workPlaces(): HasMany
    {
        return $this->hasMany( WorkPlace::class, 'id_campo_laboral', 'id');
    }
}
