<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function getPDF(){
      $pdf = PDF::loadView('pdf.costumer');
      return $pdf->download('costumer.pdf');
    }
}
