<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Images extends Model
{
    // props
    protected $table = 'imagenes';
    protected $fillable = [
        'id_oferta',
        'imagen',
        'catalogo_principal',
        'catalogo_licenciatura'
    ];
    public $timestamps = true;

    // relationships
    public function offer(): BelongsTo
    {
        return $this->belongsTo( AcademicOffer::class, 'id_oferta', 'id' );
    }
}
