<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VirtualTour extends Model
{
    // props
    protected $table = 'recorridos_virtuales';
    protected $fillable = [
        'id_oferta',
        'url'
    ];
    public $timestamps = true;

    // relationships
    public function offer(): BelongsTo
    {
        return $this->belongsTo( AcademicOffer::class, 'id_oferta', 'id' );
    }
}
