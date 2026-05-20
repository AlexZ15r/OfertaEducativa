<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

use App\Models\EducationalProgram;

class PlanSociologiaController extends Controller
{
    protected $pe;

    public function generar(EducationalProgram $pe)
    {
        // get plan info
        $this->pe = $pe;

        // create pdf
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // get subjects array
        $asignaturas = $this->pe->subjects()->with('areas')->get();
        $asignaturas->groupBy('educational_program__subject.semester');

        $html = view('pdf.plan_sociologia', [
            'nombre' => $this->pe->name,
            'creditos_min_max' => $this->pe->information?->creditos_min_max,
            'area' => $this->pe->areas,
            'asignaturas' => $asignaturas,
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="Plan_de_Estudios_Sociologia.pdf"',
            ]
        );
    }
}
