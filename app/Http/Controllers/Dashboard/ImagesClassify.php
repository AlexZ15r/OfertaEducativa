<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AcademicOffer;
use App\Models\Images;

class ImagesClassify extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AcademicOffer $offer, Images $image)
    {
        // validate
        $request->validate([
            'type' => ['required', 'string', 'in:main,banner']
        ], [
            'type.required' => 'El campo tipo es requerido',
            'type.in' => 'Tipo desconocido'
        ]);

        // validate image belongs to offer
        if ( !$offer->images()->where('id', $image->id)->exists() ) {
            return response()->json(['status' => 'no', 'message' => 'La imagen no pertenece a la oferta educativa, incidente reportado a neptuno']);
        }

        // update status
        if ( $request->type == 'main' ) {
            $oldStatus = $image->catalogo_principal;
            if ( $oldStatus ) {
                $image->catalogo_principal = false;
            } else {
                $image->catalogo_principal = true;
            }
            $image->save();
        }
        if ( $request->type == 'banner' ) {
            $oldStatus = $image->catalogo_licenciatura;
            if ( $oldStatus ) {
                $image->catalogo_licenciatura = false;
            } else {
                $image->catalogo_licenciatura = true;
            }
            $image->save();
        }

        // response
        return response()->json(['status' => 'ok', 'currentStatus' => !$oldStatus]);
    }
}
