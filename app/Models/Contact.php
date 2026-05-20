<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    // props
    protected $table = 'contacto';
    protected $fillable = [
        'id_oferta',
        'contacto'
    ];
    public $timestamps = true;

    // relationships
    public function offer(): BelongsTo
    {
        return $this->belongsTo( AcademicOffer::class, 'id_oferta', 'id' );
    }
}
