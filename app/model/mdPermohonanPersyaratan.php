<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mdPermohonanPersyaratan extends Model
{
    protected $table        = "permohonan_persyaratan";
    protected $primaryKey   = "permohonan_persyaratanId";

    protected $appends = [
        'statusUpload'
    ];

    function getstatusUploadAttribute() {
       if($this->file == null){
           $btnUpload = true;
           $download = false;
       }
       else{
           $btnUpload = false;
           $download = true;
       }
       $data = array(
           "upload" => $btnUpload,
           "progress"  => false,
           "download"  => $download
       );
       return $data;
    }
}
