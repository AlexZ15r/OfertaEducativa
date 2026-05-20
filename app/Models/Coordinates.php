<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coordinates extends Model
{
    // props
    protected $table = 'coordenadas';
    protected $fillable = [
        'id_oferta',
        'latitud',
        'longitud'
    ];
    public $timestamps = true;

    // relationships
    public function offer(): BelongsTo
    {
        return $this->belongsTo( AcademicOffer::class, 'id_oferta', 'id' );
    }
}
