<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 06.11.2018
 * Time: 22:39
 */

namespace App\Http\Model\Service;

use Illuminate\Support\Facades\DB;

class FileModel extends BaseModelService {
    protected static $table = "cms_pliki";

    public function getFileBySciezka($sciezka){
        $result = DB::select('SELECT * FROM '.self::$table.' WHERE sciezka="'.$sciezka.'"');
        return $result;
    }

    public function insert($data){
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

    public function update($data,$id){
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        $sql = "UPDATE ".self::$table." SET ";
        $data_count = count($data);
        $counter = 0;
        if($data_count > 1 ){
            foreach($data as $k => $v ){
                $counter++;
                if($counter == $data_count){
                    $sql = $sql." ".$k." = ".$v.", ";
                } else {
                    $sql = $sql." ".$k." = ".$v." ";
                }
            }
        } else{
            foreach($data as $k => $v ) {
                $sql = $sql . " " . $k . " = '" . $v . "' ";
            }
        }

        $sql = $sql." WHERE id=".$id;
        $result = DB::update($sql);
        return $result;
    }

}