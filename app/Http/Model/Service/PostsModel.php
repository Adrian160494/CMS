<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 01.12.2018
 * Time: 22:05
 */
namespace App\Http\Model\Service;

use App\Http\Model\Service\BaseModelService;
use Illuminate\Support\Facades\DB;

class PostsModel extends BaseModelService {
    protected static $table = "cms_posts";
    protected static $table_join = "cms_category";

    public function getPosts($id_projektu){
        $result = DB::select("SELECT cp.*,cc.name as category FROM ".self::$table." as cp 
        LEFT JOIN cms_category as cc ON cc.id = cp.id_category
        WHERE cp.id_projektu = ".$id_projektu);
        return $result;
    }

    public function getPostById($id){
        $result = DB::select("SELECT cp.*,cc.name as category FROM ".self::$table." as cp 
        LEFT JOIN cms_category as cc ON cc.id = cp.id_category
        WHERE cp.id=".$id);
        return $result;
    }

    public function delete($id){
        $result = DB::delete("DELETE FROM ".self::$table." WHERE id=".$id);
        return $result;
    }

    public function changeActivity($id){
        $result = DB::select("SELECT is_active FROM ".self::$table." WHERE id=".$id);
        if($result[0]->is_active){
            DB::update('UPDATE '.self::$table.' SET is_active=0 WHERE id='.$id);
            return 0;
        } else {
            DB::update('UPDATE '.self::$table.' SET is_active=1 WHERE id='.$id);
            return 1;
        }
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
                    $sql = $sql." ".$k." = '".$v."' ";
                } else {
                    $sql = $sql." ".$k." = '".$v."', ";
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