<?php

namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

class ProjektyModel {
    protected static $table = "cms_projekty";

    public static function getProjekty(){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE 1= 1");
        return $result;
    }
}