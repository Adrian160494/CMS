<?php
namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

class BaseModel {
    protected static $table = null;

    public static function select(){
        $result = DB::select("SELECT * FROM ".self::$table);
        return $result;
    }

    public static function selectWhere($id){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE id=".$id);
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
                $sql = $sql." ".$k." = ".$v.", ";
            } else {
                $sql = $sql." ".$k." = ".$v." ";
            }
        }
        $sql = $sql." WHERE id=".$id;
        $result = DB::update($sql);
        return $result;
    }


}