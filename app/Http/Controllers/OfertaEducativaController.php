<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainArea;
use App\Models\AcademicOffer;
use App\Models\EducationalProgram;
use App\Models\Campus;
use App\Models\AcademicUnit;
use App\Models\Modality;

class OfertaEducativaController extends Controller
{
    // props
    protected $menu;
    protected $educationalPrograms;
    protected $campus;
    protected $academicUnits;
    protected $modalities;

    public function __invoke()
    {
        $this->init();
        return view('oferta.index', [
            'img' => asset('images/arena-buap.jpg'),
            'main' => $this->menu,
            'newOffer' => $this->menu->find(6),
            'educationalPrograms' => $this->educationalPrograms,
            'campus' => $this->campus,
            'academicUnits' => $this->academicUnits,
            'modalities' => $this->modalities,
        ]);
    }

    public function init() {
        // build menu structure
        $menu = MainArea::orderBy('aparicion')->get();
        $this->menu = $menu->map(function ($area) {
            $area->aus = $area->offer->groupBy('academicUnit.id')->map(function ($offers) {
                return (object) [
                    'id' => $offers->first()->academicUnit->id,
                    'name' => $offers->first()->academicUnit->name,
                    'eps' => $offers->map(function ($offer) {
                        return (object) [
                            'id' => $offer->id,
                            'campus' => $offer->campus->name,
                            'name' => $offer->educationalProgram->name
                        ];
                    }),
                ];
            })->values();
            unset($area->offer);
            return $area;
        });

        // query search form
        $activeEps = AcademicOffer::where('active', true)->distinct()->pluck('educational_program_id');
        $this->educationalPrograms = AcademicOffer::select(
                'campus__academic_unit__educational_program.id as key',
                \DB::raw("CONCAT(educational_programs.name, ' (', campus.name, ')') as name")
            )
            ->join('public.educational_programs', 'campus__academic_unit__educational_program.educational_program_id', '=', 'educational_programs.id')
            ->join('public.campus', 'campus__academic_unit__educational_program.campus_id', '=', 'campus.id')
            ->whereIn('campus__academic_unit__educational_program.educational_program_id', $activeEps)
            ->orderBy('campus__academic_unit__educational_program.id')
            ->get();
        $this->campus = Campus::select('key', 'name')->orderBy('name')->get()->toArray();
        $this->academicUnits = AcademicUnit::select('key', 'name')->where('type', 'academic')->orderBy('name')->get()->toArray();
        $this->modalities = Modality::select('nombre as key', 'nombre as name')->orderBy('nombre')->get()->toArray();
    }
}
