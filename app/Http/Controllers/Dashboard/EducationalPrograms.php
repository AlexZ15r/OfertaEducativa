<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\EducationalProgram as EducationalProgramModel;

class EducationalPrograms extends Controller
{
    // props

    //  Handle the incoming request.
    public function __invoke(Request $request)
    {
        // props
        $academicManagers = User::role('gestor_curricular')->get();
        $educationalPrograms = EducationalProgramModel::where('type', 'superior')->orderBy('name')->orderBy('key')->get();

        // response
        return view('dashboard.educational-programs.index', [
            'esAdministrador' => Auth::user()->hasAnyRole(['administrador','gestor_curricular']),
            'academicManagers' => $academicManagers,
            'educationalPrograms' => $educationalPrograms,
        ]);
    }
}
