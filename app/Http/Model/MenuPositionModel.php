<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 06.11.2018
 * Time: 22:39
 */

namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

class MenuPositionModel extends BaseModel {
    protected static $table = "cms_menu_positions";

    public static function getMenuPositionsByProject($id){
        $result =DB::select("SELECT * FROM ".self::$table." WHERE id_menu=".$id);
        $menu = array();
        foreach ($result as $m){
            if(!$m->id_parent_submenu){
                $m->childs = array();
                foreach ($result as $s){
                    if($s->id_parent_submenu == $m->id){
                        array_push($m->childs, $s);
                    }
                }
                array_push($menu,$m);
            }
        }
        foreach ($menu as $me){
            foreach ($me->childs as $ch){
                if($ch->id_parent_submenu){
                    $ch->childs = array();
                    foreach ($result as $r){
                        if($r->id_parent_submenu == $ch->id){
                            array_push($ch->childs,$r);
                        }
                    }
                }
            }
        }
        foreach ($menu as $me){
            foreach ($me->childs as $ch){
                foreach($ch->childs as $ch2){
                    if($ch2->id_parent_submenu){
                        $ch2->childs = array();
                        foreach ($result as $r){
                            if($r->id_parent_submenu == $ch2->id){
                                array_push($ch2->childs,$r);
                            }
                        }
                    }
                }
            }
        }
        return $menu;
    }

    public static function deletePositionMenu($id){
        $result = DB::delete("DELETE FROM ".self::$table." WHERE id=".$id.' OR id_parent_submenu='.$id);
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