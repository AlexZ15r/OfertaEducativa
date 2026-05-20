<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\AcademicOffer;
use App\Models\Images;

class ImageDelete extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AcademicOffer $offer, Images $image)
    {
        // validate image belongs to offer
        if ($image->id_oferta !== $offer->id) {
            Alert::error('Acción denegada', 'La imagen no pertenece a la oferta académica especificada');
            return redirect()->route('dashboard.images', ['offer' => $offer->id]);
        }

        // delete attached file
        Storage::disk('public')->delete($image->imagen);

        // delete image register
        $image->delete();

        // response
        return redirect()->route('dashboard.images', ['offer' => $offer->id]);
    }
}
