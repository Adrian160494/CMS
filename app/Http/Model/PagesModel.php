<?php

namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

class PagesModel extends BaseModel {
    protected static $table = "cms_projekty_strony";

    public static function getPagesById($id){
        $result =DB::select("SELECT * FROM ".self::$table." WHERE id_projektu=".$id);
        return $result;
    }

    public static function addMainPage($id){
        $result = DB::insert("INSERT INTO ".self::$table." (`id_projektu`,`nazwa`,`route`,`content`,`slug`) VALUES ('".$id."','Strona glowna','/',null,'main_page')");
        return $result;
    }

    public static function deletePage($id){
        $result = DB::delete("DELETE FROM ".self::$table." WHERE id=".$id);
        return $result;
    }

    public static function insert($data){
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        $sql = "INSERT INTO ".self::$table." (";
        $sql_a = ") VALUES (";
        $data_count = count($data);
        $counter = 0;
        foreach($data as $k => $v ){
            $counter++;
            if($counter == $data_count){
                $sql = $sql."`".$k."`";
                $sql_a = $sql_a."'".$v."'";
            } else {
                $sql = $sql."`".$k."`,";
                $sql_a = $sql_a."'".$v."',";
            }
        }
        $sql_a = $sql_a.")";
        $sql_r = $sql.$sql_a;
        $result = DB::insert($sql_r);
        return $result;
    }
}