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

class ImagesSizeModel extends BaseModelService {
    protected static $table = "cms_images_size";

    public function getSizes($id){
        $result = DB::select("SELECT * FROM ".self::$table." WHERE id_picture=".$id);
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

}