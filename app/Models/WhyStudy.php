<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhyStudy extends Model
{
    // props
    protected $table = 'porque_estudiar';
    protected $fillable = [
        'educational_program_id',
        'porque_estudiar'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo( EducationalProgram::class, 'educational_program_id', 'id' );
    }
}
