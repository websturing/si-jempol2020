<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use QrCode;

class pdfControl extends Controller
{
    function index(Request $r){
        $type = $r->get("type");
        if($type == 'routingSlip'){
            return self::routingSlip($r);
        }
    }

    function routingSlip(){
        $pdf = PDF::loadView('pdf.routingSlip');
        return $pdf->stream('invoice.pdf');
    }
}
