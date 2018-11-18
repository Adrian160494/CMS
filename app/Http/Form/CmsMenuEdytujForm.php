<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 30.10.2018
 * Time: 21:22
 */

namespace App\Http\Form;

class CmsMenuEdytujForm extends Form{
    protected $form_name = 'cms_menu_edytuj_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('hidden','id_projektu','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Nazwa','','label-custom'),
            'input'=>Form::createInput('text','nazwa','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Zapisz','','btn-1 btn-long','Zapisz')
        ));

        return self::$form_elements;
    }

}