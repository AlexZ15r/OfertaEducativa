<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KnowledgeArea extends Model
{
    // props
    protected $table = 'areas_conocimiento';
    protected $fillable = [
        'nombre',
        'nivel',
        'color'
    ];
    public $timestamps = true;

    // relationships
    public function educationalPrograms(): BelongsToMany
    {
        return $this->belongsToMany( EducationalProgram::class, 'lic_area_conocimiento', 'id_area_conocimiento', 'educational_program_id' )
                    ->withTimestamps();
    }
}
