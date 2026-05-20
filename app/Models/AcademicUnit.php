<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AcademicUnit extends Model
{
    // props
    protected $table  = 'public.academic_units';
    protected $fillable = [
        'name',
        'key',
        '_key',
        'type'
    ];
    public $timestamps = true;

    // relationships
    public function offer(): HasMany
    {
        return $this->hasMany( AcademicOffer::class, 'academic_unit_id', 'id' );
    }
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'public.academic_unit__subject', 'academic_unit_id', 'subject_id' );
    }
    public function educationalPrograms(): BelongsToMany
    {
        return $this->belongsToMany( EducationalProgram::class, 'public.academic_unit__educational_program', 'academic_unit_id', 'educational_program_id' )
                    ->using( AcademicUnitEducationalProgram::class )
                    ->withPivot(['id'])
                    ->withTimestamps();
    }
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany( User::class, 'public.academic_managers', 'academic_unit_id', 'user_id' )
                    ->using( AcademicManager::class )
                    ->withPivot(['active'])
                    ->withTimestamps();
    }
}
