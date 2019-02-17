<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 06.11.2018
 * Time: 22:39
 */

namespace App\Http\Model\Service;

use Illuminate\Support\Facades\DB;

class GalleryElementsModel extends BaseModelService {
    protected static $table = "cms_gallery_elements";
    protected static $firstJoin = "cms_pliki";

    public function getElements($id_banneru){
        $result = DB::select('
        SELECT cbe.*,cp.nazwa as plik, cp.sciezka as sciezka_plik FROM '.self::$table.' as cbe
         LEFT JOIN '.self::$firstJoin.' as cp ON cbe.id_plik = cp.id
         WHERE id_gallery='.$id_banneru
        );
        return $result;
    }

    public function getElementById($id){
        $result = DB::select('
        SELECT cbe.*,cp.nazwa as plik,cp.id as id_pliku, cp.sciezka as sciezka_plik, cp.typ as typ FROM '.self::$table.' as cbe
         LEFT JOIN '.self::$firstJoin.' as cp ON cbe.id_plik = cp.id
         WHERE cbe.id='.$id
        );
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
}