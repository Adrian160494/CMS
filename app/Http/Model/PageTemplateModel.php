<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 03.11.2018
 * Time: 01:47
 */
namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

class PageTemplateModel extends BaseModel {
    protected static $table = "cms_page_templates";

    public static function getPagesById($id){
        $result =DB::select("SELECT * FROM ".self::$table." WHERE id_projektu=".$id);
        return $result;
    }

}