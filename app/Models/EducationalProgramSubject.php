<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationalProgramSubject extends Pivot
{
    // props
    protected $table = 'public.educational_program__subject';
    protected $fillable = [
        'educational_program_id',
        'subject_id',
        'semester',
        'area_id'
    ];
    public $timestamps = true;

    // relationships
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function precedents(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'precedents', 'educational_program__subject_id', 'precedent_id' )
                    ->withTimestamps();
    }
    public function consequents(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'consequents', 'educational_program__subject_id', 'consequent_id' )
                    ->withTimestamps();
    }
    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany( Subject::class, 'prerequisites', 'educational_program__subject_id', 'prerequisite_id' )
                    ->withTimestamps();
    }
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
}
