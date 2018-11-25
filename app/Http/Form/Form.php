<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 28.10.2018
 * Time: 12:19
 */

namespace App\Http\Form;

class Form{
    function __construct()
    {

    }

    public static function createInput($type,$name,$hint,$class,$value=null,$placeholder=null){
        return array('type'=>$type,'name'=>$name,'hint'=>$hint,'class'=>$class,'value'=>$value,'placeholder'=>$placeholder);
    }
    public static function createFile($type,$name,$hint,$class,$value=null,$placeholder=null){
        return array('type'=>$type,'name'=>$name,'hint'=>$hint,'class'=>$class,'value'=>$value,'placeholder'=>$placeholder);
    }
    public static function createLabel($name,$hint,$class){
        return array('type'=>'label','name'=>$name,'hint'=>$hint,'class'=>$class);
    }
    public static function createSelect($name,$class,$values,$default){
        return array('type'=>'select','name'=>$name,'class'=>$class,'values'=>$values,'default'=>$default);
    }
    public static function createTextarea($type,$name,$hint,$class,$value=null,$placeholder=null,$cols,$rows){
        return array('type'=>$type,'name'=>$name,'hint'=>$hint,'class'=>$class,'value'=>$value,'placeholder'=>$placeholder,'cols'=>$cols,'rows'=>$rows);
    }
}