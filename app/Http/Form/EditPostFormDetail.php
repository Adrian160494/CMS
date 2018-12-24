<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 30.10.2018
 * Time: 21:22
 */

namespace App\Http\Form;

class EditPostFormDetail extends Form{
    protected $form_name = 'edit_post_form_detail';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Treść','','label-custom'),
            'input'=>Form::createTextarea('textarea','description','','custom-form-input','','',900,17),
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Dodaj','','btn-1 btn-long','')
        ));

        return self::$form_elements;
    }

}