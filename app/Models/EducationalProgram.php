<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\EducationalProgramSubject;
use App\Models\SubjectTerminalArea;

class EducationalProgram extends Model
{
    // props
    protected $table = 'public.educational_programs';
    protected $fillable = [
        'type',
        'key',
        '_key',
        '__key',
        'name',
        'active',
        'with_terminals'
    ];
    public $timestamps = true;

    // relationships
    public function offer(): HasMany
    {
        return $this->hasMany( AcademicOffer::class, 'educational_program_id', 'id' );
    }
    public function academicUnits(): BelongsToMany
    {
        return $this->belongsToMany( AcademicUnit::class, 'public.academic_unit__educational_program', 'educational_program_id', 'academic_unit_id' )
                    ->using( AcademicUnitEducationalProgram::class )
                    ->withPivot(['id'])
                    ->withTimestamps();
    }
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'public.educational_program__subject', 'educational_program_id', 'subject_id' )
                    ->using(EducationalProgramSubject::class)
                    ->withPivot(['semester','area_id'])
                    ->withTimestamps();
    }
    public function areas(): BelongsToMany
    {
        return $this->belongsToMany( Area::class, 'public.area__educational_program', 'educational_program_id', 'area_id' )
                    ->withTimestamps();
    }
    public function terminals(): HasMany
    {
        return $this->hasMany( TerminalArea::class, 'educational_program_id', 'id' );
    }
    public function profiles(): HasOne
    {
        return $this->hasOne( Profile::class, 'educational_program_id', 'id' );
    }
    public function employmentArea(): HasOne
    {
        return $this->hasOne( EmploymentArea::class, 'educational_program_id', 'id' );
    }
    public function information(): HasOne
    {
        return $this->hasOne( Information::class, 'educational_program_id', 'id' );
    }
    public function admissionGraduationImages(): HasOne
    {
        return $this->hasOne( AdmissionGraduationImages::class, 'educational_program_id', 'id' );
    }
    public function knowledgeAreas(): BelongsToMany
    {
        return $this->belongsToMany( KnowledgeArea::class, 'lic__area_conocimiento', 'educational_program_id', 'id_area_conocimiento' )
                    ->withTimestamps();
    }
    public function complete(): HasOne
    {
        return $this->hasOne( Complete::class, 'educational_program_id', 'id' );
    }
    public function whyStudy(): HasOne
    {
        return $this->hasOne( WhyStudy::class, 'educational_program_id', 'id' );
    }
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany( User::class, 'public.curriculum_managers', 'educational_program_id', 'user_id' )
                    ->using( CurriculumManager::class )
                    ->withPivot(['active'])
                    ->withTimestamps();
    }
    public function coordinators(): BelongsToMany
    {
        return $this->belongsToMany( User::class, 'public.educational_program_coordinators', 'educational_program_id', 'user_id' )
                    ->using( EducationalProgramCoordinator::class )
                    ->withPivot(['active'])
                    ->withTimestamps();
    }
    public function oldOffer(): HasOne
    {
        return $this->hasOne( OldOfferUrl::class, 'educational_program_id', 'id' );
    }

    // attributes
    public function semestersList()
    {
        return EducationalProgramSubject::where('educational_program_id', $this->id)
                ->distinct()
                ->orderBy('semester')
                ->pluck('semester')
                ->filter();
    }

    public function groupedSubjectsBySemester()
    {
        return EducationalProgramSubject::with(['subject', 'area'])
                ->where('educational_program_id', $this->id)
                ->whereNotNull('semester')
                ->whereHas('subject', function ($q) {
                    $q->where('subject_type', 'Disciplinaria');
                })
                ->orderBy('semester')
                ->get()
                ->groupBy('semester')
                ->map(fn ($areas) =>
                    $areas
                        ->sortBy('area.name')
                        ->groupBy('area.name')
                        ->map(fn($subjects) =>
                            $subjects->sortBy('subject.title')
                        )
                );
    }

    public function groupedOptativesByAreaAndSemester()
    {
        return EducationalProgramSubject::with(['subject', 'area'])
            ->where('educational_program_id', $this->id)
            ->whereNotNull('semester')
            ->whereHas('subject', function ($q) {
                $q->where('subject_type', 'Optativa Disciplinaria')
                ->whereDoesntHave('terminalArea');
            })
            ->orderBy('semester')
            ->get()
            ->groupBy('semester')
            ->map(fn ($areas) =>
                $areas
                    ->sortBy('area.name')
                    ->groupBy('area.name')
                    ->map(fn($subjects) =>
                        $subjects->sortBy('subject.title')
                    )
            );
    }

    public function groupedElectiveOptativesByAreaAndSemester()
    {
        return EducationalProgramSubject::with(['subject', 'area'])
            ->where('educational_program_id', $this->id)
            ->whereNotNull('semester')
            ->whereHas('subject', function ($q) {
                $q->where('subject_type', 'Optativa Complementaria');
            })
            ->orderBy('semester')
            ->get()
            ->groupBy('semester')
            ->map(fn ($subjects) =>
                $subjects
                    ->sortBy('area.name')
                    ->groupBy('area.name')
                    ->map(fn($subjects) =>
                        $subjects->sortBy('subject.title')
                    )
            );
    }

    public function groupedSubjectsByTerminalAreaAndSemester()
    {
        return SubjectTerminalArea::with([
                'subject',
                'area',
                'terminalArea'
            ])
            ->whereHas('terminalArea', function ($q) {
                $q->where('educational_program_id', $this->id);
            })
            ->orderBy('semester')
            ->get()
            ->groupBy('terminalArea.name')
            ->map(fn ($items) =>
                $items->groupBy('semester')
                    ->map(fn ($semesterItems) =>
                        $semesterItems->groupBy('area.name')->map(fn($subjects) =>
                            $subjects->sortBy('subject.title')
                        )
                    )
            );
    }
}
