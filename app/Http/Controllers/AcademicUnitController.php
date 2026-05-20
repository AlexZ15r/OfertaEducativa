<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AcademicUnit;

class AcademicUnitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $academicUnit)
    {
        // get academi unit
        $academicUnitModel = AcademicUnit::where('key', $academicUnit)->first();
        if ( !$academicUnitModel ) {
            abort(404);
        }

        // response
        return view('oferta.academic-unit', [
            'academicUnitName' => $academicUnitModel->name,
            'offer' => $academicUnitModel
                            ->offer()
                            ->with(['campus', 'educationalProgram'])
                            ->get()
                            ->groupBy('campus.name')
                            ->map(fn ($campus) => $campus->map(fn ($offer) => (object)[
                                'id' => $offer->id,
                                'educationalProgram' => $offer->educationalProgram?->name
                            ]))
        ]);
    }
}
