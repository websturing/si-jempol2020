<?php

namespace App\Http\Controllers;

use App\model\mdopdIzin;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;

class persyaratanControl extends Controller
{
    function jsonApi(Request $r)
    {
        $izin = mdopdIzin::with(['persyaratan', 'opd'])->get();

        return FacadesResponse::json($izin, 200, array('Content-Type' => 'application/javascript'));
    }
}
