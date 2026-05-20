<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AcademicManager extends Pivot
{
    // props
    protected $table = 'public.academic_managers';
    protected $fillable = [
        'user_id',
        'academic_unit_id',
        'active'
    ];
    public $timestamps = true;
}
