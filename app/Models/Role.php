<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // schema.table name
    protected $table = 'public.roles';

    // roles list
    const ADMINISTRATOR_ROLE = 'administrador';
    const TEACHER_ROLE = 'docente';
    const EVALUATOR_ROLE = 'evaluador';
    const COORDINATOR_ROLE = 'coordinador';
    const DIRECTOR_ROLE = 'director';
    const SECRETARY_ROLE = 'secretario';
    const STUDENT_ROLE = 'alumno';
    const VICECHANCELLOR_ROLE = 'vicerrector';
    const HIRING_EVALUATOR_ROLE = 'evaluador_contrataciones';
    const CURRICULUM_MANAGER_ROLE = 'gestor_curricular';
    const ACADEMIC_MANAGER_ROLE = 'gestor_academico';
    const VIEWER_ROLE = 'visor';
}
