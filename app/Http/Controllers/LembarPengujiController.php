<?php

namespace App\Http\Controllers;

use App\Models\Spm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LembarPengujiController extends Controller
{
    //
     public function preview()
    {
        $spms = Spm::latest()->where('status_ajukan', 'sp2d terbit')->get();

         $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'spms' => $spms
        ]; 

        $pdf = Pdf::loadView('pdf.lembar-penguji', $data);

        return $pdf->stream('lembar-penguji.pdf'); // tetap preview
    }
}
