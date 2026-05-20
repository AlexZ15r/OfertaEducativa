<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OldOfferUrl extends Model
{
    // props
    protected $table = 'old_offer_urls';
    protected $fillable = [
        'educational_program_id',
        'url'
    ];
    public $timestamps = true;

    // relationships
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo(EducationalProgram::class, 'educational_program_id', 'id');
    }
}
