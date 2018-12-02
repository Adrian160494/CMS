<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 31.10.2018
 * Time: 23:00
 */

namespace App\Http\Form;

class AddPictureSizeForm extends Form{
    protected $form_name = 'add_picture_size';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Szerokość','','label-custom'),
            'input'=>Form::createInput('text','width','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Wysokość','','label-custom'),
            'input'=>Form::createInput('text','height','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','submit','','btn-1 btn-long','Zapisz')
        ));

        return self::$form_elements;
    }

}