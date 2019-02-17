<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 28.10.2018
 * Time: 13:04
 */

namespace App\Http\Form;

class LoginForm extends Form{
    protected $form_name = 'login_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Username','','label-custom'),
            'input'=>Form::createInput('text','username','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Password','','label-custom'),
            'input'=>Form::createInput('password','password','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Zaloguj','','btn-1 btn-long','Submit')
        ));

        return self::$form_elements;
    }

}