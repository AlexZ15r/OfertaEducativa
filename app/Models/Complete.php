<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complete extends Model
{
    // props
    protected $table = 'completos';
    protected $fillable = [
        'educational_program_id',
        'completo'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo( EducationalProgram::class, 'educational_program_id', 'id' );
    }
}
