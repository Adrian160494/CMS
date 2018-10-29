<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 27.10.2018
 * Time: 18:56
 */
namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

class User{

    private static $table = "cms_users";

    public static function getUserByUsername($username){
        $result = DB::select('SELECT * FROM '.self::$table.' WHERE username="'.$username.'"');
        return $result;
    }
}