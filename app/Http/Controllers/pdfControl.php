<?php

namespace App\Http\Controllers;

use App\mdPermohonan;
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

    function routingSlip(Request $r){
        $id = $r->get("id");
        $data = mdPermohonan::with(['opd','persyaratan','izin','perusahaan','pemohon'])
                            ->where('permohonan_id',$id)
                            ->get();
        $p = $data[0];

        $pdf = PDF::loadView('pdf.routingSlip', compact('p'));
        return $pdf->stream('invoice.pdf');
    }
}
