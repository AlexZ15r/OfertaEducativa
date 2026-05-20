<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Campus extends Model
{
    // props
    protected $table = 'public.campus';
    protected $fillable = [
        'key',
        'name'
    ];
    public $timestamps = true;

    // relationships
    public function offer(): HasMany
    {
        return $this->hasMany( AcademicOffer::class, 'campus_id', 'id' );
    }

}
