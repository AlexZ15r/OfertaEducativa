<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CurriculumManager extends Pivot
{
    // props
    protected $table = 'public.curriculum_managers';
    protected $fillable = [
        'user_id',
        'educational_program_id',
        'active'
    ];
    public $timestamps = true;
}
