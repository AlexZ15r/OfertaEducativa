<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectTerminalArea extends Pivot
{
    // props
    protected $table  = 'public.subject__terminal_area';
    protected $fillable = [
        'subject_id',
        'terminal_area_id',
        'semester',
        'area_id'
    ];
    public $timestamps = true;

    // relationships
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
    public function terminalArea(): BelongsTo
    {
        return $this->belongsTo(TerminalArea::class, 'terminal_area_id', 'id');
    }
}
