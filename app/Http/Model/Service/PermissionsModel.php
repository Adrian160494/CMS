<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 06.11.2018
 * Time: 22:39
 */

namespace App\Http\Model\Service;

use Illuminate\Support\Facades\DB;

class PermissionsModel extends BaseModelService {
    protected static $table = "cms_permissions";
    protected static $table_join = "cms_users_types";

    public function getPermissions(){
        $result = DB::select("SELECT cp.*,cut.type as type FROM ".self::$table." as cp 
         LEFT JOIN cms_users_types as cut ON cut.id = cp.account_type 
         ORDER BY cp.action ASC");
        return $result;
    }

    public function getPermissionByAction($action){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE action ='".$action."'");
        return $result;
    }

    public static function changeActivity($id){
        $result = DB::select("SELECT permission FROM ".self::$table." WHERE id=".$id);
        if($result[0]->permission){
            DB::update('UPDATE '.self::$table.' SET permission=0 WHERE id='.$id);
            return 0;
        } else {
            DB::update('UPDATE '.self::$table.' SET permission=1 WHERE id='.$id);
            return 1;
        }
    }

    public function getPermissionByActionAndType($action,$type){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE action='".$action."' AND account_type=".$type);
        return $result;
    }


    public function insert($data){
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

    public function update($data,$email){
        $sql = "UPDATE ".self::$table." SET ";
        $data_count = count($data);
        $counter = 0;
        if($data_count > 1 ){
            foreach($data as $k => $v ){
                $counter++;
                if($counter == $data_count){
                    $sql = $sql." ".$k." = ".$v." ";
                } else {
                    $sql = $sql." ".$k." = ".$v.", ";
                }
            }
        } else{
            foreach($data as $k => $v ) {
                $sql = $sql . " " . $k . " = '" . $v . "' ";
            }
        }

        $sql = $sql." WHERE email='".$email."'";
        $result = DB::update($sql);
        return $result;
    }
}