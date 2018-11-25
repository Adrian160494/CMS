<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 31.10.2018
 * Time: 23:00
 */

namespace App\Http\Form;

class CreateBanerElementForm extends Form{
    protected $form_name = 'create_baner_element_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('hidden','id_baneru','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Nazwa','','label-custom'),
            'input'=>Form::createInput('text','nazwa','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Opis','','label-custom'),
            'input'=>Form::createTextarea('textarea','opis','','custom-form-input','','',100,5),
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Plik','','label-custom'),
            'input'=>Form::createFile('file','file','Dołącz plik jpg','custom-form-input','')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Aktywność','','label-custom'),
            'input'=>Form::createInput('checkbox','is_active','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','submit','','btn-1 btn-long','Zapisz')
        ));

        return self::$form_elements;
    }

}