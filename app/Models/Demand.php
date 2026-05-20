<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demand extends Model
{
    // props
    protected $table = 'oferta_academica.demanda';
    protected $fillable = [
        'id_lic__modalidad',
        'demanda',
        'cpp'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgramModality(): BelongsTo
    {
        return $this->belongsTo( EducationalProgramModality::class, 'id_lic__modalidad', 'id' );
    }
}
