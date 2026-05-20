<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\AcademicOffer;
use App\Models\User;

class DetailsIndex extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AcademicOffer $offer)
    {
        // props
        $user = Auth::user();
        $academicManagers = User::role('gestor_curricular')->get();
        $active = $request->active;

        // validate user can edit offer
        if (
            !(
                $user->hasAnyRole(['administrador','gestor_curricular'])
                ||
                (
                    $user->hasAnyRole(['director','secretario','coordinador'])
                    &&
                    ($user->academicUnits->first()->id == $offer->academicUnit?->id)
                )
            )
        ) {
            abort(403);
        }

        // response
        return view('dashboard.public-offer.details.index', [
            'esAdministrador' => $user->hasAnyRole(['administrador','gestor_curricular']),
            'canEditWhyStudy' => $offer->origin,
            'canEditUas' => $user->hasAnyRole(['administrador','gestor_curricular','director','secretario','coordinador']),
            'canEditDes' => $user->hasAnyRole(['administrador','gestor_curricular']),
            'academicManagers' => $academicManagers,
            'offerId' => $offer->id,
            'offerName' => $offer->academicUnit?->name . " - " . $offer->campus?->name . " - " . $offer->educationalProgram?->name,
            'active' => $active,
            'offer' => $offer,
            'workPlaces' => $offer->educationalProgram?->employmentArea?->workPlaces()->pluck('sitio') ?? []
        ]);
    }
}
