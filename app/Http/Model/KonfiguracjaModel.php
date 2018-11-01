<?php

namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

class KonfiguracjaModel extends BaseModel {
    public static $table = "cms_projekty_konfiguracja";

    public static function selectWhere($id){
        $result = DB::select("SELECT sciezka_server, sciezka_route, sciezka_view  FROM ".self::$table." WHERE id_projektu=".$id);
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

    public static function update($data,$id){
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        $sql = "UPDATE ".self::$table." SET ";
        $data_count = count($data);
        $counter = 0;
        foreach($data as $k => $v ){
            $counter++;
            if($counter == $data_count){
                $sql = $sql." `".$k."` = '".$v."' ";
            } else {
                $sql = $sql." `".$k."` = '".$v."', ";
            }
        }
        $sql = $sql." WHERE id_projektu=".$id;
        $result = DB::update($sql);

        return $result;
    }

    public static function czyIstnieje($id){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE id_projektu=".$id);
        if($result){
            return 1;
        } else {
            return 0;
        }
    }

}