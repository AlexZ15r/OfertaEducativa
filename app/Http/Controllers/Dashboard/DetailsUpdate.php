<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AcademicOffer;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class DetailsUpdate extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AcademicOffer $offer)
    {
        // validation
        $request->validate([
            'form' => [
                'required',
                'string',
                'in:whyStudy,contact,coordinates,admissionProfile,graduationProfile,employmentArea'
            ],

            'whyStudy' => ['nullable', 'string'],
            'contact' => ['nullable', 'string'],

            'coordinates' => ['nullable', 'array', 'size:2'],
            'coordinates.x' => ['nullable', 'numeric', 'between:-90,90'],
            'coordinates.y' => ['nullable', 'numeric', 'between:-180,180'],

            'admissionProfile' => ['nullable', 'string'],
            'graduationProfile' => ['nullable', 'string'],
            'employmentArea' => ['nullable', 'string'],
            'workplaces' => ['nullable', 'array'],
            'workplaces.*' => ['nullable', 'string'],

        ], [
            'form.required' => 'Debe especificar qué formulario se está editando',
            'form.in' => 'El formulario a editar no es válido',

            'coordinates.array' => 'Las coordenadas deben ser enviadas como un array',
            'coordinates.size' => 'Las coordenadas deben ser latitud y longitud',
            'coordinates.x.numeric' => 'Formato inválido para indicar latitud',
            'coordinates.x.between' => 'Formato inválido para indicar latitud',
            'coordinates.y.numeric' => 'Formato inválido para indicar longitud',
            'coordinates.y.between' => 'Formato inválido para indicar longitud',
            'workplaces.array' => 'Se debe especificar un listado de áreas laborales',
        ]);

        // save info
        if ( $request->filled('whyStudy') ) {
            $whyStudy = $offer->educationalProgram->whyStudy;
            if ( $whyStudy ) {
                $whyStudy->update([
                    'porque_estudiar' => $request->whyStudy
                ]);
            } else {
                $offer->educationalProgram->whyStudy()->create([
                    'porque_estudiar' => $request->whyStudy
                ]);
            }
        }

        if ( $request->filled('contact') ) {
            $contact = $offer->contact;
            if ( $contact ) {
                $contact->update([
                    'contacto' => $request->contact
                ]);
            } else {
                $offer->contact()->create([
                    'contacto' => $request->contact
                ]);
            }
        }

        if ( $request->filled('coordinates') && ($request->coordinates['x'] || $request->coordinates['y']) ) {
            $coordinates = $offer->coordinates;
            if ( $coordinates ) {
                $coordinates->update([
                    'latitud' => $request->coordinates['x'],
                    'longitud' => $request->coordinates['y']
                ]);
            } else {
                $offer->coordinates()->create([
                    'latitud' => $request->coordinates['x'],
                    'longitud' => $request->coordinates['y']
                ]);
            }
        }

        if ( $request->filled('admissionProfile') || $request->filled('graduationProfile') ) {
            $profiles = $offer->educationalProgram->profiles;
            if ( $profiles ) {
                $profiles->update([
                    'perfil_ingreso' => $request->admissionProfile,
                    'perfil_egreso' => $request->graduationProfile
                ]);
            } else {
                $offer->educationalProgram->profiles()->create([
                    'perfil_ingreso' => $request->admissionProfile,
                    'perfil_egreso' => $request->graduationProfile
                ]);
            }
        }

        if ( $request->filled('employmentArea') ) {
            $employmentArea = $offer->educationalProgram->employmentArea;
            if ( $employmentArea ) {
                $employmentArea->update([
                    'campo_laboral' => $request->employmentArea
                ]);
            } else {
                $offer->educationalProgram->employmentArea()->create([
                    'campo_laboral' => $request->employmentArea
                ]);
            }
        }

        if ( $request->filled('workplaces') ) {
            // query employment area first
            $employmentArea = $offer->educationalProgram->employmentArea;
            if ( !$employmentArea ) {
                $employmentArea = $offer->educationalProgram->employmentArea()->create([
                    'campo_laboral' => 'Campo laboral'
                ]);
            }

            // sanitize incoming workplaces
            $incoming = collect($request->input('workplaces', []))
                            ->map(fn ($wp) => trim($wp))
                            ->filter()
                            ->unique()
                            ->values();

            // get current workplaces
            $current = $employmentArea->workPlaces()->pluck('sitio');

            // calc deletes & inserts
            $toDelete = $current->diff( $incoming );
            $toInsert = $incoming->diff( $current );

            // delete
            if ($toDelete->isNotEmpty()) {
                $employmentArea->workPlaces()
                    ->whereIn('sitio', $toDelete)
                    ->delete();
            }

            // insert
            foreach ($toInsert as $wp) {
                $employmentArea->workPlaces()->create([
                    'sitio' => $wp
                ]);
            }
        }

        // response
        Alert::success('Información actualizada');
        return redirect()->route('dashboard.details', ['offer' => $offer->id, 'active' => $request->form]);
    }
}
