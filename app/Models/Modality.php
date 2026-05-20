<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Modality extends Model
{
    // props
    protected $table = 'modalidades';
    protected $fillable = ['nombre'];
    public $timestamps = true;

    // relationships
    public function offer(): BelongsToMany
    {
        return $this->belongsToMany( AcademicOffer::class, 'lic__modalidad', 'id_modalidad', 'id_oferta' )
                    ->using(EducationalProgramModality::class)
                    ->withTimestamps();
    }
}
