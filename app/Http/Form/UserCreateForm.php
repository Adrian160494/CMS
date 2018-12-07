<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 30.10.2018
 * Time: 21:22
 */

namespace App\Http\Form;

class UserCreateForm extends Form{
    protected $form_name = 'create_user';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Imię','','label-custom'),
            'input'=>Form::createInput('text','username','','custom-form-input','')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Email','','label-custom'),
            'input'=>Form::createInput('text','email','','custom-form-input','')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Typ','','label-custom'),
            'input'=>Form::createSelect('account_type','custom-form-select','',''),
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Dodaj','','btn-1 btn-long','')
        ));

        return self::$form_elements;
    }

}