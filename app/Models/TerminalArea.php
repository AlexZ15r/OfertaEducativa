<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TerminalArea extends Model
{
    // props
    protected $table = 'public.terminal_areas';
    protected $fillable = [
        'ecuational_program_id',
        'name'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo( EducationalProgram::class, 'educational_program_id', 'id' );
    }
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'public.subject__terminal_area', 'terminal_area_id', 'subject_id')
                    ->withPivot(['semester','area_id']);
    }
}
