<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mdopdIzin extends Model
{
    protected $table        = "opd_izin";
    protected $primaryKey   = "opdi_id";

    protected $appends = [
        'value'
    ];

    function getvalueAttribute() {
        return $this->nama_izin;
    }

    function persyaratan(){
        return $this->hasMany(mdopdPersyartaan::class, "opdi_id");
    }

    function opd(){
        return $this->belongsTo(mdOpd::class, "opd_id");
    }
}
