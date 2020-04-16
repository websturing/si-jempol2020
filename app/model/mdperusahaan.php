<?php

namespace App\model;

use App\mdPermohonan;
use Illuminate\Database\Eloquent\Model;

class mdperusahaan extends Model
{
    protected $table        = "perusahaan";
    protected $primaryKey   = "perusahaan_id";

    protected $appends = [
        'fullname'
    ];

    function getfullnameAttribute() {
        return $this->status.'. '. $this->nama;
    }

    function permohonan(){
        return $this->hasMany(mdPermohonan::class,'perusahaan_id');
    }
}
