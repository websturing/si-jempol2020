<?php

namespace App\Http\Controllers;

use App\model\mdopdIzin;
use Illuminate\Http\Request;

class opdIzinControl extends Controller
{
    function index(Request $r){
        $type = $r->get("type");
        if($type == "namaIzin"){
            return self::namaIzin($r);
        }
        elseif($type == "izinById"){
            return self::izinById($r);
        }
    }
    
    function namaIzin(){
        $izin = mdopdIzin::get();
        $izin->makeHidden(['nama_izin']);
        return $izin;
    }

    function izinById(Request $r){
        $id = $r->get("id");

        $izin = mdopdIzin::with('persyaratan','opd')
                    ->where("opdi_id", $id)
                    ->get();

        return $izin;
    }

    

}
