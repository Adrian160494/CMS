<?php

namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

class ProjektyModel extends BaseModel {
    protected static $table = "cms_projekty";

    public static function getProjekty(){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE 1= 1");
        return $result;
    }

    public static function getProjektBySlug($slug){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE slug='".$slug."'");
        return $result;
    }
    public static function getProjektById($id){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE id=".$id);
        return $result;
    }

    public static function addProjekt($data){
        $result = DB::insert("INSERT INTO ".self::$table." (`nazwa`,`url`,`slug`,`is_active`) VALUES ('".$data["nazwa"]."','".$data["url"]."','".$data["slug"]."','".$data["is_active"]."')");
        return $result;
    }

    public static function removeProjekt($id){
        $result = DB::delete("DELETE FROM ".self::$table." WHERE id=".$id);
        return $result;
    }
}