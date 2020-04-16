<?php

namespace App\Http\Controllers;

use App\model\mdperusahaan;
use Illuminate\Http\Request;

class perusahaanControl extends Controller
{
    function index(Request $r){
        $type = $r->get("type");
        if($type == 'dataAll'){
            return self::dataall($r);
        }
        elseif($type == 'dataBynpwp'){
            return self::dataBynpwp($r);
        }
        elseif($type == 'UpdateById'){
            return self::UpdateById($r);
        }
    }

    function dataall(Request $r){
        return mdperusahaan::all();
    }

    function dataBynpwp(Request $r){
        $npwp = $r->get('npwp');
        return mdperusahaan::with(['permohonan' => function($p){
                        $p->with(['opd','persyaratan','izin','perusahaan']);
                    }])
                    ->where('npwp', $npwp)->get();
    }

    function UpdateById(Request $r){
        $data = $r->get('data');
        $toDB = array(
            "npwp"      => $data['npwp'],
            "status"    => $data['status'],
            "nama"      => $data['nama'],
            "alamat"    => $data['alamat'],
            "email"     => $data['email'],
            "contact"   => $data['contact'],
        );

        mdperusahaan::where('perusahaan_id', $data['perusahaan_id'])->update($toDB);

        return array(
            "title"     => "Info",
            "type"      => "success",
            "message"   => "Data Berhasil Di Rubah",
            "code"      => "200"
        );
    }
}
