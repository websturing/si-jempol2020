<?php

namespace App\Http\Controllers;

use App\mdPermohonan;
use App\model\mdopdIzin;
use Illuminate\Http\Request;
use PDF;
use QrCode;
use Illuminate\Support\Facades\Crypt;

class pdfControl extends Controller
{
    function index(Request $r)
    {
        $type = $r->get("type");
        if ($type == 'routingSlip') {
            return self::routingSlip($r);
        }
    }

    function routingSlip(Request $r)
    {
        $id = $r->get("id");
        $data = mdPermohonan::with(['opd', 'persyaratan', 'izin', 'perusahaan', 'pemohon'])
            ->where('permohonan_id', $id)
            ->get();
        $p = $data[0];

        $pdf = PDF::loadView('pdf.routingSlip', compact('p'));
        return $pdf->stream('invoice.pdf');
    }

    function PersyaratanPDF(Request $r)
    {
        if ($id = Crypt::decryptString($r->get("id"))) {
            $data = mdopdIzin::with(['persyaratan', 'opd'])
                ->where("opdi_id", $id)
                ->get();
            $p = $data[0];

            $pdf = PDF::loadView('pdf.persyaratan', compact('p'));
            return $pdf->stream($p->nama_izin . '.pdf');
        } else {
            return "error";
        }
    }
}
