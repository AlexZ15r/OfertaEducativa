<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AcademicOffer;

class LicenciaturaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AcademicOffer $educationalProgram)
    {
        // props
        $offerId = $educationalProgram->id;
        $educationalProgramModel = $educationalProgram->educationalProgram;
        $showOld = $educationalProgramModel->oldOffer;
        if ($request->has('admin')) {
            $showOld = false;
        }
        $showUPAMessage = in_array($educationalProgramModel->id, [244,246,259]);
        $showDualEducationMessage = in_array($educationalProgramModel->id, [69,211]);
        $haveANote = in_array($educationalProgramModel->id, [194]);
        $campus = $educationalProgram->campus?->name;
        $activeEps = AcademicOffer::where('active', true)->distinct()->pluck('educational_program_id');
        $educationalPrograms = AcademicOffer::select(
                'campus__academic_unit__educational_program.id as key',
                \DB::raw("CONCAT(educational_programs.name, ' (', campus.name, ')') as name")
            )
            ->join('public.educational_programs', 'campus__academic_unit__educational_program.educational_program_id', '=', 'educational_programs.id')
            ->join('public.campus', 'campus__academic_unit__educational_program.campus_id', '=', 'campus.id')
            ->whereIn('campus__academic_unit__educational_program.educational_program_id', $activeEps)
            ->orderBy('campus__academic_unit__educational_program.id')
            ->get();
        $educationalProgramName = $educationalProgramModel->name;
        $images = $educationalProgram->images()->where('catalogo_licenciatura', true)->pluck('imagen');
        $banner = $images->count() > 0 ? $images->random() : 'arena-buap.jpg';
        $area = $educationalProgramModel->knowledgeAreas()->select('nombre', 'color')->first();
        $modalities = $educationalProgram->modalities;
        $whyStudy = $educationalProgramModel->whyStudy?->porque_estudiar;
        $employmentArea = $educationalProgramModel->employmentArea?->campo_laboral;
        $workPlaces = $educationalProgramModel->employmentArea->workPlaces;
        $creditos = $educationalProgramModel->information?->creditos_min_max;
        $withTerminals = $educationalProgramModel->with_terminals;
        $terminals = $educationalProgramModel->groupedSubjectsByTerminalAreaAndSemester()->toArray() ?? [];
        $subjects = $educationalProgramModel->groupedSubjectsBySemester()->toArray() ?? collect();
        $semesterCount = $educationalProgramModel->subjects()->distinct()->count('educational_program__subject.semester');
        $semestersList = $educationalProgramModel->semestersList()->toArray();
        $optativeDisciplinarySubjects = $educationalProgramModel->groupedOptativesByAreaAndSemester()->toArray() ?? [];
        $optativeComplementarySubjects = $educationalProgramModel->groupedElectiveOptativesByAreaAndSemester()->toArray() ?? [];
        $semesters = [
            "" => ['text' => 'Sin Semestre', 'icon' => '<img src="' . asset('images/carrera/semesters/0.png') . '" alt="Semestre 0" class="semester-number">'],
            "1" => ['text' => 'Primer', 'icon' => '<img src="' . asset('images/carrera/semesters/1.png') . '" alt="Semestre 1" class="semester-number">'],
            "2" => ['text' => 'Segundo', 'icon' => '<img src="' . asset('images/carrera/semesters/2.png') . '" alt="Semestre 2" class="semester-number">'],
            "2.5" => ['text' => 'Primer', 'icon' => '<img src="' . asset('images/carrera/semesters/1.png') . '" alt="Interperiodo 1" class="semester-number">'],
            "3" => ['text' => 'Tercer', 'icon' => '<img src="' . asset('images/carrera/semesters/3.png') . '" alt="Semestre 3" class="semester-number">'],
            "4" => ['text' => 'Cuarto', 'icon' => '<img src="' . asset('images/carrera/semesters/4.png') . '" alt="Semestre 4" class="semester-number">'],
            "4.5" => ['text' => 'Segundo', 'icon' => '<img src="' . asset('images/carrera/semesters/2.png') . '" alt="Interperiodo 2" class="semester-number">'],
            "5" => ['text' => 'Quinto', 'icon' => '<img src="' . asset('images/carrera/semesters/5.png') . '" alt="Semestre 5" class="semester-number">'],
            "6" => ['text' => 'Sexto', 'icon' => '<img src="' . asset('images/carrera/semesters/6.png') . '" alt="Semestre 6" class="semester-number">'],
            "6.5" => ['text' => 'Tercer', 'icon' => '<img src="' . asset('images/carrera/semesters/3.png') . '" alt="Interperiodo 3" class="semester-number">'],
            "7" => ['text' => 'Séptimo', 'icon' => '<img src="' . asset('images/carrera/semesters/7.png') . '" alt="Semestre 7" class="semester-number">'],
            "8" => ['text' => 'Octavo', 'icon' => '<img src="' . asset('images/carrera/semesters/8.png') . '" alt="Semestre 8" class="semester-number">'],
            "8.5" => ['text' => 'Cuarto', 'icon' => '<img src="' . asset('images/carrera/semesters/4.png') . '" alt="Interperiodo 4" class="semester-number">'],
            "9" => ['text' => 'Noveno', 'icon' => '<img src="' . asset('images/carrera/semesters/9.png') . '" alt="Semestre 9" class="semester-number">'],
            "10" => ['text' => 'Décimo', 'icon' => '<img src="' . asset('images/carrera/semesters/1.png') . '" alt="Semestre 1" class="semester-number" style="transform: translateX(25px);">' . '<img src="' . asset('images/carrera/semesters/0.png') . '" alt="Semestre 0" class="semester-number">'],
            "10.5" => ['text' => 'Quinto', 'icon' => '<img src="' . asset('images/carrera/semesters/5.png') . '" alt="Interperiodo 5" class="semester-number">'],
            "11" => ['text' => 'Onceavo', 'icon' => '<img src="' . asset('images/carrera/semesters/1.png') . '" alt="Semestre 11" class="semester-number" style="transform: translateX(25px);">' . '<img src="' . asset('images/carrera/semesters/1.png') . '" alt="Semestre 11" class="semester-number">'],
            "12" => ['text' => 'Doceavo', 'icon' => '<img src="' . asset('images/carrera/semesters/1.png') . '" alt="Semestre 12" class="semester-number" style="transform: translateX(25px);">' . '<img src="' . asset('images/carrera/semesters/2.png') . '" alt="Semestre 12" class="semester-number">'],
        ];
        $profileImages = $educationalProgramModel->admissionGraduationImages;
        $profiles = $educationalProgramModel->profiles()->select('perfil_ingreso', 'perfil_egreso')->first();
        $virtualTour = $educationalProgram->virtualTours?->first()?->url;
        $offer = $educationalProgramModel->offer()->with(['campus', 'academicUnit', 'contact', 'coordinates', 'images'])->get();

        // response
        return view('oferta.licenciatura', [
            'offerId' => $offerId,
            'showOld' => $showOld,
            'showUPAMessage' => $showUPAMessage,
            'showDualEducationMessage' => $showDualEducationMessage,
            'haveANote' => $haveANote,
            'campus' => $campus,
            'educationalPrograms' => $educationalPrograms,
            'educationalProgramId' => $educationalProgramModel->id,
            'educationalProgramName' => $educationalProgramName,
            'area' => $area,
            'banner' => $banner,
            'modalities' => $modalities,
            'whyStudy' => $whyStudy,
            'employmentArea' => $employmentArea,
            'workPlaces' => $workPlaces,
            'creditos' => $creditos,
            'withTerminals' => $withTerminals,
            'terminals' => $terminals,
            'optativeDisciplinarySubjects' => $optativeDisciplinarySubjects,
            'optativeComplementarySubjects' => $optativeComplementarySubjects,
            'subjects' => $subjects,
            'semesters' => $semesters,
            'semesterCount' => $semesterCount,
            'semestersList' => $semestersList,
            'profileImages' => $profileImages,
            'profiles' => $profiles,
            'virtualTour' => $virtualTour,
            'offer' => $offer,
        ]);
    }
}
