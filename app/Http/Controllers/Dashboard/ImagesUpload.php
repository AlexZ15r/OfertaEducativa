<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

use App\Models\AcademicOffer;

class ImagesUpload extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AcademicOffer $offer)
    {
        // validate
        $request->validate([
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'max:20480'],
        ],[
            'images.required' => 'El campo imágenes es requerido',
            'images.array' => 'Se debe enviar una colección de imágenes',
            'images.min' => 'Debe seleccionar al menos una imagen',
            'images.*.image' => 'Formato de imagen no detectado',
            'images.*.max' => 'El tamaño de los archivos no puede superar los 20MB',
        ]);

        // get route parts
        $idCampus = $offer->campus->id;
        $idAcademicUnit = $offer->academicUnit->id;
        $idEducationalProgram = $offer->educationalProgram->id;
        $location = "sedes/{$idCampus}/unidades/{$idAcademicUnit}/licenciaturas/{$idEducationalProgram}";

        // save images
        $manager = new ImageManager(new Driver());
        foreach ($request->file('images') as $imageFile) {
            // get actual name
            $name = Str::random(10) . '.webp';

            // store compressed file
            $image = $manager->read($imageFile);
            $webp = $image->toWebp(80);
            Storage::disk('public')->put($location.'/'.$name, $webp);

            // create image record
            $offer->images()->create([
                'imagen' => $location.'/'.$name,
                'catalogo_principal' => false,
                'catalogo_licenciatura' => false,
            ]);
        }

        // response
        Alert::success('Información actualizada');
        return redirect()->route('dashboard.images', ['offer' => $offer->id]);
    }
}
