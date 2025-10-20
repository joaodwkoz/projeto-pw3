<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use Barryvdh\DomPDF\Facade\Pdf;


class PDFController extends Controller
{
    public function downloadPDF()
    {
        $funcionarios = Funcionarios::all();

        $dados = compact('funcionarios');

        $pdf = Pdf::loadView('funcionario_pdf', $dados);

        return $pdf->download('documento.pdf');

      
    }
}
