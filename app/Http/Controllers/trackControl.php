<?php

namespace App\Http\Controllers;

use App\model\mdTrack;
use Illuminate\Http\Request;

class trackControl extends Controller
{
    function index(Request $r)
    {
        $type = $r->get("type");
        if ($type == 'trackById') {
            return self::trackById($r);
        }
    }

    function trackById(Request $r)
    {
        $permohonan_id = $r->get("permohonan_id");
        $track = mdTrack::where("permohonan_id", $permohonan_id)->get();

        return $track;
    }
}
