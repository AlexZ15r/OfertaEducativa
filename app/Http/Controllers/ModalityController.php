<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Modality;

class ModalityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $modality)
    {
        // get campus
        $modalityModel = Modality::where('nombre', $modality)->first();
        if ( !$modalityModel ) {
            abort(404);
        }

        // response
        return view('oferta.modality', [
            'modalityName' => $modalityModel->nombre,
            'offer' => $modalityModel
                            ->offer()
                            ->with(['campus', 'academicUnit', 'educationalProgram'])
                            ->get()
                            ->groupBy('campus.name')
                            ->map(fn ($campus) => $campus->map(fn ($offer) => (object)[
                                'id' => $offer->id,
                                'educationalProgram' => $offer->educationalProgram?->name
                            ]))
        ]);
    }
}
