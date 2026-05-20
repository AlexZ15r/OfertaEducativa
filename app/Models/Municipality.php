<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    // props
    protected $table = 'municipios';
    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'tiene_buap'
    ];
    public $timestamps = true;
}
