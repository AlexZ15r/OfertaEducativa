<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Area extends Model
{
    //  props
    protected $table = 'public.areas';
    protected $fillable = [
        'name',
        'color'
    ];
    public $timestamps = true;

    // relationships
    public function subjectsByEducationalProgram(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'public.educational_program__subject', 'area_id', 'subject_id' );
    }
    public function subjectsByTerminalArea(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'public.subject__terminal', 'area_id', 'subject_id' );
    }
    public function educationalPrograms(): BelongsToMany
    {
        return $this->belongsToMany( EducationalProgram::class, 'public.area__educational_program', 'area_id', 'educational_program_id' )
                    ->withTimestamps();
    }
}
