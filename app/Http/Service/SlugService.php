<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 01.11.2018
 * Time: 23:41
 */

namespace App\Http\Service;

class SlugService{

    public static function createSlug($name){
        $slug = str_replace(" ","_",mb_strtolower($name));
        return $slug;
    }
}