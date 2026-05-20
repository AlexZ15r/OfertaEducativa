<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AcademicOffer extends Model
{
    // props
    protected $table = 'public.campus__academic_unit__educational_program';
    protected $fillable = [
        'campus_id',
        'academic_unit_id',
        'educational_program_id',
        'origin',
        'active'
    ];
    public $timestamps = true;

    // relationships
    public function campus(): BelongsTo
    {
        return $this->belongsTo( Campus::class, 'campus_id', 'id' );
    }
    public function academicUnit(): BelongsTo
    {
        return $this->belongsTo( AcademicUnit::class, 'academic_unit_id', 'id' );
    }
    public function educationalProgram(): BelongsTo
    {
        return $this->belongsTo( EducationalProgram::class, 'educational_program_id', 'id' );
    }
    public function virtualTours(): HasMany
    {
        return $this->hasMany( VirtualTour::class, 'id_oferta', 'id' );
    }
    public function modalities(): BelongsToMany
    {
        return $this->belongsToMany( Modality::class, 'oferta_academica.lic__modalidad', 'id_oferta', 'id_modalidad' )
                    ->using(EducationalProgramModality::class)
                    ->withPivot(['id'])
                    ->withTimestamps();
    }
    public function mainArea(): BelongsToMany
    {
        return $this->belongsToMany( MainArea::class, 'oferta_academica.lic__area_principal', 'id_oferta', 'id_area_principal' )
                    ->withTimestamps();
    }
    public function images(): HasMany
    {
        return $this->hasMany( Images::class, 'id_oferta', 'id' );
    }
    public function coordinates(): HasOne
    {
        return $this->hasOne( Coordinates::class, 'id_oferta', 'id' );
    }
    public function contact(): HasOne
    {
        return $this->hasOne( Contact::class, 'id_oferta', 'id' );
    }

    // attributes
    public function detailsComplete()
    {
        // form 1 completo
        $form1 = (boolean) $this->educationalProgram?->whyStudy?->porque_estudiar;
        // form 2 completo
        $form2 = (boolean) $this->contact?->contacto;
        // form 3 completo
        $form3 = (boolean) $this->coordinates?->latitud && $this->coordinates?->longitud;
        // form 4 completo
        $form4 = (boolean) $this->educationalProgram?->profiles?->perfil_ingreso;
        // form 5 completo
        $form5 = (boolean) $this->educationalProgram?->profiles?->perfil_egreso;
        // form 6 completo
        $form6 = (boolean) $this->educationalProgram?->employmentArea?->campo_laboral;
        return $form1 && $form2 && $form3 && $form4 && $form5 && $form6;
    }
}
