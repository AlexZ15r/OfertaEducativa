<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\Relations\HasOne;

class EducationalProgramModality extends Pivot
{
    // props
    protected $table = 'oferta_academica.lic__modalidad';
    protected $fillable = [
        'id_oferta',
        'id_modalidad'
    ];
    public $timestamps = true;

    // relationships
    public function demand(): HasOne
    {
        return $this->hasOne( Demand::class, 'id_lic__modalidad', 'id' );
    }
}
