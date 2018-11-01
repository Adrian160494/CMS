<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 31.10.2018
 * Time: 23:00
 */

namespace App\Http\Form;

class KonfiguracjaForm extends Form{
    protected $form_name = 'konfiguracja_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Sciezka projektu','','label-custom'),
            'input'=>Form::createInput('text','sciezka_server','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Sciezka routingu','','label-custom'),
            'input'=>Form::createInput('text','sciezka_route','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Sciezka widoków','','label-custom'),
            'input'=>Form::createInput('text','sciezka_view','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('hidden','id_projektu','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','submit','','btn-1 btn-long','Zapisz')
        ));

        return self::$form_elements;
    }

}