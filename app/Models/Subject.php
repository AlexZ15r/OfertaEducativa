<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    // props
    protected $table = 'public.subjects';
    protected $fillable = [
        'key',
        'title',
        'purpose',
        'theoretical_hours',
        'practical_hours',
        'level',
        'credits',
        'is_approved',
        'type',
        'approved_at',
        'teacher_identifier',
        'educational_program_year',
        'iw_hours',
        'area_id',
        'subject_type'
    ];
    public $timestamps = true;

    // relationships
    public function academicUnits(): BelongsToMany
    {
        return $this->belongsToMany( AcademicUnit::class, 'public.academic_unit__subject', 'subject_id', 'academic_unit_id' );
    }
    public function educationalPrograms(): BelongsToMany
    {
        return $this->belongsToMany( EducationalProgram::class, 'public.educational_program__subject', 'subject_id', 'educational_program_id' )
                    ->using(EducationalProgramSubject::class)
                    ->withPivot(['semester','area_id'])
                    ->withTimestamps();
    }
    public function precedentOf(): BelongsToMany
    {
        return $this->belongsToMany( EducationalProgramSubject::class, 'public.precedents', 'precedent_id', 'educational_program__subject_id' )
                    ->withTimestamps();
    }
    public function consequentOf(): BelongsToMany
    {
        return $this->belongsToMany( EducationalProgramSubject::class, 'public.consequents', 'consequent_id', 'educational_program__subject_id' )
                    ->withTimestamps();
    }
    public function prerequisitesOf(): BelongsToMany
    {
        return $this->belongsToMany( EducationalProgramSubject::class, 'public.prerequisites', 'prerequisite_id', 'educational_program__subject_id' )
                    ->withTimestamps();
    }
    public function electives(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'public.electives', 'subject_id', 'elective_id' );
    }
    public function electiveOf(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'public.electives', 'elective_id', 'subject_id' );
    }
    public function areasByEducationalProgram(): BelongsToMany
    {
        return $this->belongsToMany( Area::class, 'public.educational_program__subject', 'subject_id', 'area_id' );
    }
    public function areasByTerminalArea(): BelongsToMany
    {
        return $this->belongsToMany( Area::class, 'public.subject__terminal_area', 'subject_id', 'area_id' );
    }
    public function terminalArea(): BelongsToMany
    {
        return $this->belongsToMany(TerminalArea::class, 'public.subject__terminal_area', 'subject_id', 'terminal_area_id')
                    ->withPivot(['semester']);
    }
}
