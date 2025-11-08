<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Estudiante;

class ReportePdfController extends Controller
{
    public function estudiantes()
    {
        $estudiantes = Estudiante::orderBy('nombres')->get();

        $pdf = Pdf::loadView('pdf.reporte', compact('estudiantes'));

        return $pdf->stream('reporte-estudiantes.pdf');
    }
}
