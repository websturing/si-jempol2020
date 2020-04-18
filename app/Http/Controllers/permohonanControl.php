<?php

namespace App\Http\Controllers;

use App\mdPermohonan;
use App\model\mdPermohonanPersyaratan;
use App\Http\Controllers\perusahaanControl;
use App\Http\Controllers\perusahaanPemohonControl;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class permohonanControl extends Controller
{
    function index(Request $r){
        $type = $r->get("type");
        if($type == 'dataByDate'){
            return self::dataByDate($r);
        }
        else if($type == 'dataById'){
            return self::dataById($r);
        }
        else if($type == 'insert'){
            return self::insertPermohonan($r);
        }
        else if($type == 'uploadSingle'){
            return self::uploadSingle($r);
        }
        else if($type == 'dataByRange'){
            return self::dataByRange($r);
        }
    }

    /*----------------------=== GET DATA BY ===-----------------------*/

    function dataByDate(Request $r){
        $date = date("Y-m-d", strtotime($r->get('date')));

        $dataByDate = mdPermohonan::with(['izin','perusahaan','opd','persyaratan'])
                                ->whereDate('created_at', $date)
                                ->orderBy('created_at', 'DESC')
                                ->get();

        return $dataByDate;
    }
    function dataByRange(Request $r){
        $start = date("Y-m-d", strtotime($r->get('date')[0]));
        $end = date("Y-m-d", strtotime($r->get('date')[1]));
        return mdPermohonan::with(['izin','perusahaan','opd','persyaratan'])
                            ->whereBetween("created_at",[$start, $end])
                            ->orderBy('created_at', 'DESC')
                            ->get();
    }
    function dataById(Request $r){
        $id = $r->get('id');

        $dataById = mdPermohonan::with(['izin','perusahaan','opd','persyaratan'])
                                ->where('permohonan_id', $id)
                                ->get();

        return $dataById;
    }

    function uploadSingle(Request $r){
        date_default_timezone_set("Asia/Bangkok");
        $timestamp = date("Y-m-d H:i:s");

        $persyaratan = $r->get("persyaratan");
        $permohonanCode = $r->get("permohonanCode");
        Storage::makeDirectory("permohonan/".$permohonanCode);
        Storage::makeDirectory("permohonan/".$permohonanCode.'/persyaratan');

        $expoloded = explode(",", $persyaratan["file"]);
        $decoded = base64_decode($expoloded[1]);
        $extension =  "pdf";
        $name = Str::slug($persyaratan["persyaratan"], '_');
        $filename = $name.'.'.$extension;
        $path = storage_path('app/permohonan/'.$permohonanCode.'/persyaratan').'/'.$filename;
        file_put_contents($path, $decoded);

        $arPers = array(
            "file" => $filename,
            "updated_at" => $timestamp,
            "user_uploaded_file" => Session::get("user_id"),
        );
        mdPermohonanPersyaratan::where("permohonan_persyaratanId", $persyaratan["permohonan_persyaratanId"])
            ->update($arPers);
        
        return $filename;
        
    }
    function UploadSuratTelaah(Request $r){
        date_default_timezone_set("Asia/Bangkok");
        $timestamp = date("Y-m-d H:i:s");

        $persyaratan = $r->get("persyaratan");
        $permohonanCode = $r->get("permohonanCode");
        Storage::makeDirectory("permohonan/".$permohonanCode);
        Storage::makeDirectory("permohonan/".$permohonanCode.'/rekomendasi');

        $expoloded = explode(",", $persyaratan["file"]);
        $decoded = base64_decode($expoloded[1]);
        $extension =  "pdf";
        $name = Str::slug($persyaratan["nomor"], '_');
        $filename = $name.'.'.$extension;
        $path = storage_path('app/permohonan/'.$permohonanCode.'/rekomendasi').'/'.$filename;
        file_put_contents($path, $decoded);

        // $arPers = array(
        //     "file" => $filename,
        //     "updated_at" => $timestamp,
        //     "user_uploaded_file" => Session::get("user_id"),
        // );
        // mdPermohonanPersyaratan::where("permohonan_persyaratanId", $persyaratan["permohonan_persyaratanId"])
        //     ->update($arPers);
        
        return $filename;
        
    }

    /*----------------------=== CRUD ===-----------------------*/

    function insertPermohonan(Request $r){
        $data = $r->get("form");
        $perusahaan = new Request();
        $perusahaan->replace(['perusahaan' => $data['perusahaan']]);

        $perusahaan_id = perusahaanControl::Insertperusahaan($perusahaan);
        $data['pemohon']['perusahaan_id'] =  $perusahaan_id;
        $perusahaan_pemohon = new Request();
        $perusahaan_pemohon->replace(['pemohon' => $data['pemohon']]);
        $perusahaan_pemohon_id = perusahaanPemohonControl::perusahaanpemohonInsert($perusahaan_pemohon);

        $code ='PRMN';
        $pegawaiCode = DB::table('permohonan')->where('permohonan_code', 'like', '%' . $code . '%')->max('permohonan_code');
        $idmax1 = $pegawaiCode;
        $nourut1 = (int) substr($idmax1, 4,5);
        $nourut1++;
        $permohonan_code = $code . sprintf("%05s", $nourut1);
        
        $toDBpermohonan = array(
            "permohonan_code"   => $permohonan_code,
            "perusahaan_id"     => $perusahaan_id,  
            "perusahaanp_id"    => $perusahaan_pemohon_id,
            "opd_id"            => $data["izin"]["opd_id"],
            "opdi_id"           => $data["izin"]["opdi_id"],    
            "status"            => "proses", 
            "create_on"         => "walkin"
        );
        mdPermohonan::insert($toDBpermohonan);
        $permohonanId = DB::getPdo()->lastInsertId();

        foreach($data["persyaratan"] as $index => $p){
            $toDbPersyaratan = array(
                "permohonan_id" => $permohonanId,
                "persyaratan" => $p["persyaratan"],
                "status" => "waiting-upload",
                "catatan" => $p["catatan"]
            );
            mdPermohonanPersyaratan::insert($toDbPersyaratan);
        }

                


        return array(
            "title"     => "Info",
            "type"      => "success",
            "message"   => "Data Berhasil Di Simpan",
            "code"      => "200",
            "dataId"        => $permohonanId
        );
    }
}
