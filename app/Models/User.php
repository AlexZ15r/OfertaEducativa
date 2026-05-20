<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    // props
    protected $table = 'public.users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // relationships
    public function academicUnits()
    {
        return $this->belongsToMany(
            AcademicUnit::class,
            'public.academic_unit__user',
            'user_id',
            'academic_unit_id'
        );
    }

    public function managedAcademicUnits(): BelongsToMany
    {
        return $this->belongsToMany(
            AcademicUnit::class,
            'public.academic_managers',
            'user_id',
            'academic_unit_id'
        )
        ->using(AcademicManager::class)
        ->withPivot(['active'])
        ->withTimestamps();
    }

    public function managedEducationalPrograms(): BelongsToMany
    {
        return $this->belongsToMany(
            EducationalProgram::class,
            'public.curriculum_managers',
            'user_id',
            'educational_program_id'
        )
        ->using(CurriculumManager::class)
        ->withPivot(['active'])
        ->withTimestamps();
    }

    public function coordinatedEducationalPrograms(): BelongsToMany
    {
        return $this->belongsToMany(
            EducationalProgram::class,
            'public.educational_program_coordinators',
            'user_id',
            'educational_program_id'
        )
        ->using(EducationalProgramCoordinator::class)
        ->withPivot(['active'])
        ->withTimestamps();
    }

    // attributes
    public function getIsTeacherAttribute(){
        return $this->hasRole(Role::TEACHER_ROLE);
    }

    public function getIsAdministratorAttribute()
    {
        return $this->hasRole(Role::ADMINISTRATOR_ROLE);
    }

    public function getIsDirectorAttribute()
    {
        return $this->hasRole(Role::DIRECTOR_ROLE);
    }

    public function getIsSecretaryAttribute()
    {
        return $this->hasRole(Role::SECRETARY_ROLE);
    }

    public function getIsCoordinatorAttribute()
    {
        return $this->hasRole(Role::COORDINATOR_ROLE);
    }

    public function getIsVicechancellorAttribute()
    {
        return $this->hasRole(Role::VICECHANCELLOR_ROLE);
    }

    public function getIsHiringEvaluatorAttribute()
    {
        return $this->hasRole(Role::HIRING_EVALUATOR_ROLE);
    }
    public function getIsCurriculumManagerAttribute()
    {
        return $this->hasRole(Role::CURRICULUM_MANAGER_ROLE);
    }
    public function getIsAcademicManagerAttribute()
    {
        return $this->hasRole(Role::ACADEMIC_MANAGER_ROLE);
    }
    public function getIsViewerAttribute()
    {
        return $this->hasRole(Role::VIEWER_ROLE);
    }

    public function getCargoAttribute()
    {
        if ( $this->is_administrator ) { return 'des'; }
        if ( $this->is_vicechancellor ) { return 'vicerrector'; }
        if ( $this->is_director ) { return 'dir'; }
        if ( $this->is_secretary ) { return 'sa'; }
        if ( $this->is_coordinator ) { return 'coordinador'; }
        if ( $this->is_teacher ) { return 'docente'; }
        return 'docente';
    }
}
