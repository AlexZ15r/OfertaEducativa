<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkPlace extends Model
{
    // props
    protected $table = 'sitios_trabajo';
    protected $fillable = [
        'id_campo_laboral',
        'sitio'
    ];
    public $timestamps = true;

    // relationships
    public function employmentArea(): BelongsTo
    {
        return $this->belongsTo( EmploymentArea::class, 'id_campo_laboral', 'id' );
    }
}
