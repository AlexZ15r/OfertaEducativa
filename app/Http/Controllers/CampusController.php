<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Campus;

class CampusController extends Controller
{
    // props

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $campus)
    {
        // get campus
        $campusModel = Campus::where('key', $campus)->first();
        if ( !$campusModel ) {
            abort(404);
        }

        // response
        return view('oferta.campus', [
            'campusName' => $campusModel->name,
            'offer' => $campusModel
                            ->offer()
                            ->with(['academicUnit', 'educationalProgram'])
                            ->get()
                            ->groupBy('academicUnit.name')
                            ->map(fn ($au) => $au->map(fn ($offer) => (object)[
                                'id' => $offer->id,
                                'educationalProgram' => $offer->educationalProgram?->name
                            ]))
        ]);
    }
}
