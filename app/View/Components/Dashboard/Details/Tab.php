<?php

namespace App\View\Components\Dashboard\Details;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\Auth;

use App\Models\AcademicOffer;

class Tab extends Component
{
    // props
    public $indicators;

    /**
     * Create a new component instance.
     */
    public function __construct( AcademicOffer $offer, public $origin, public $canEditUas, public $canEditDes )
    {
        $this->indicators = (object) [
            'whyStudy' => (boolean) $offer->educationalProgram?->whyStudy?->porque_estudiar,
            'contact' => (boolean) $offer->contact?->contacto,
            'coordinates' => (boolean) $offer->coordinates?->latitud && $offer->coordinates?->longitud,
            'admissionProfile' => (boolean) $offer->educationalProgram?->profiles?->perfil_ingreso,
            'graduationProfile' => (boolean) $offer->educationalProgram?->profiles?->perfil_egreso,
            'employmentArea' => (boolean) $offer->educationalProgram?->employmentArea?->campo_laboral,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.details.tab', [
            'canEditWhyStudy' => $this->origin,
            'canEditUas' => $this->canEditUas,
            'canEditDes' => $this->canEditDes,
            'indicators' => $this->indicators
        ]);
    }
}
