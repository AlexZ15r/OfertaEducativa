<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalProgramCoordinator extends Model
{
    // props
    protected $table = 'public.educational_program_coordinators';
    protected $fillable = [
        'user_id',
        'educational_program_id',
        'active'
    ];
    public $timestamps = true;
}
