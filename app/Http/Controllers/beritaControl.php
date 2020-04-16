<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class beritaControl extends Controller
{
    function imageUploaded(Request $r){
        return stripslashes(response()->json(['link' => "afriandi"])->content());
    }
}
