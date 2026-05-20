<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panopticon extends Model
{
    // props
    protected $table = 'panoptico';
    protected $fillable = [
        'identifier',
        'accion'
    ];
    public $timestamps = true;
}
