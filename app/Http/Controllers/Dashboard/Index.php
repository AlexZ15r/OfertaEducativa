<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class Index extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // props
        $academicManagers = User::role('gestor_curricular')->get();

        // response
        return view('dashboard.index', [
            'esAdministrador' => Auth::user()->hasAnyRole(['administrador','gestor_curricular']),
            'academicManagers' => $academicManagers,
        ]);
    }
}
