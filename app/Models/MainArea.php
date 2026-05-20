<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MainArea extends Model
{
    // props
    protected $table = 'areas_principales';
    protected $fillable = [
        'nombre',
        'color_titulo',
        'color_fondo_high',
        'color_fondo_low',
        'color_borde',
        'aparicion'
    ];
    public $timestamps = true;

    // relationships
    public function offer(): BelongsToMany
    {
        return $this->belongsToMany( AcademicOffer::class, 'lic__area_principal', 'id_area_principal', 'id_oferta' )
                    ->withTimestamps();
    }
}
