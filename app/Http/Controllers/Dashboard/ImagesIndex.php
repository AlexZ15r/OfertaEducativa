<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\AcademicOffer;
use App\Models\User;

class ImagesIndex extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AcademicOffer $offer)
    {
        // props
        $user = Auth::user();
        $academicManagers = User::role('gestor_curricular')->get();

        // validate user can edit offer
        if (
            !(
                $user->hasAnyRole(['administrador','gestor_curricular','visor'])
                ||
                (
                    $user->hasAnyRole(['director','secretario','coordinador'])
                    &&
                    ($user->academicUnits->first()->id == $offer->academicUnit->id)
                )
            )
        ) {
            abort(403);
        }

        // response
        return view('dashboard.public-offer.images.index', [
            'esAdministrador' => $user->hasAnyRole(['administrador','gestor_curricular']),
            'academicManagers' => $academicManagers,
            'campusId' => $offer->campus->id,
            'academicUnitId' => $offer->academicUnit->id,
            'educationalProgramId' => $offer->educationalProgram->id,
            'offerId' => $offer->id,
            'offerName' => $offer->academicUnit->name . " - " . $offer->campus->name . " - " . $offer->educationalProgram->name,
            'offerImages' => $offer->images()->orderBy('id', 'desc')->get(),
        ]);
    }
}
