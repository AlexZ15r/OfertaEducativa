<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\AcademicOffer;

class PublicOffer extends Controller
{
    // props

    //  Handle the incoming request.
    public function __invoke(Request $request)
    {
        // props
        $user = Auth::user();
        $academicUnit = $user->academicUnits()->first();
        $academicManagers = [];
        $educationalPrograms = [];

        // conditional data load
        if ( $user->is_administrator || $user->is_curriculum_manager || $user->is_viewer ) {
            $academicManagers = User::role('gestor_curricular')->get();
            $educationalPrograms = AcademicOffer::query()
                                    ->join('public.campus','campus__academic_unit__educational_program.campus_id', '=', 'campus.id')
                                    ->join('public.academic_units','campus__academic_unit__educational_program.academic_unit_id', '=', 'academic_units.id')
                                    ->join('public.educational_programs','campus__academic_unit__educational_program.educational_program_id', '=', 'educational_programs.id')
                                    ->with(['campus', 'academicUnit', 'educationalProgram'])
                                    ->orderBy('academic_units.name')
                                    ->orderBy('campus.name')
                                    ->orderBy('educational_programs.name')
                                    ->orderBy('educational_programs.key')
                                    ->select('campus__academic_unit__educational_program.*')
                                    ->get();
        } else {
            // if ( $user->is_curriculum_manager ) {
            //     $educationalPrograms = AcademicOffer::query()
            //                             ->join('public.campus','campus__academic_unit__educational_program.campus_id', '=', 'campus.id')
            //                             ->join('public.academic_units','campus__academic_unit__educational_program.academic_unit_id', '=', 'academic_units.id')
            //                             ->join('public.educational_programs','campus__academic_unit__educational_program.educational_program_id', '=', 'educational_programs.id')
            //                             ->with(['campus', 'academicUnit', 'educationalProgram'])
            //                             ->orderBy('academic_units.name')
            //                             ->orderBy('campus.name')
            //                             ->orderBy('educational_programs.name')
            //                             ->orderBy('educational_programs.key')
            //                             ->select('campus__academic_unit__educational_program.*')
            //                             ->get();

            // }
            $educationalPrograms = $academicUnit->offer()
                                    ->join('public.campus','campus__academic_unit__educational_program.campus_id', '=', 'campus.id')
                                    ->join('public.academic_units','campus__academic_unit__educational_program.academic_unit_id', '=', 'academic_units.id')
                                    ->join('public.educational_programs','campus__academic_unit__educational_program.educational_program_id', '=', 'educational_programs.id')
                                    ->with(['campus', 'academicUnit', 'educationalProgram'])
                                    ->orderBy('academic_units.name')
                                    ->orderBy('campus.name')
                                    ->orderBy('educational_programs.name')
                                    ->orderBy('educational_programs.key')
                                    ->select('campus__academic_unit__educational_program.*')
                                    ->get();
        }

        // response
        return view('dashboard.public-offer.index', [
            'esAdministrador' => $user->hasAnyRole(['administrador','gestor_curricular']),
            'canEditDetails' => $user->hasAnyRole(['administrador','gestor_curricular','director','secretario','coordinador']),
            'academicManagers' => $academicManagers,
            'educationalPrograms' => $educationalPrograms,
        ]);
    }
}
