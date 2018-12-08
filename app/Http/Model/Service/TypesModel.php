<?php
namespace App\Http\Model\Service;

use Illuminate\Support\Facades\DB;

class TypesModel extends BaseModelService{
    protected static $table = "cms_users_types";

    public function getAllTypes(){
        $result = DB::select("SELECT * FROM ".self::$table);
        return $result;
    }

    public function getTypes(){
        $result = DB::select("SELECT * FROM ".self::$table);
        $array = array();
        foreach ($result as $r){
            $array[$r->id] = $r->type;
        }
        return $array;
    }

    public function getTypeById($id){
        $result = DB::select("SELECT type FROM ".self::$table." WHERE id=".$id);
        return $result;
    }
}