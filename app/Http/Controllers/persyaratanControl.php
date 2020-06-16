<?php

namespace App\Http\Controllers;

use App\model\mdopdIzin;
use Illuminate\Http\Request;

class persyaratanControl extends Controller
{
    function jsonApi(Request $r)
    {
        $izin = mdopdIzin::with(['persyaratan', 'opd'])->get();

        return $izin;
    }
}
