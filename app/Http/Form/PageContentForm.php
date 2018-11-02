<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 30.10.2018
 * Time: 21:22
 */

namespace App\Http\Form;

class PageContentForm extends Form{
    protected $form_name = 'choose_project_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Nazwa','','label-custom'),
            'input'=>Form::createInput('text','name','','custom-form-input','')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Treść','','label-custom'),
            'input'=>Form::createTextarea('textarea','content','','custom-form-input','','',100,17),
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Dodaj','','btn-1 btn-long','')
        ));

        return self::$form_elements;
    }

}