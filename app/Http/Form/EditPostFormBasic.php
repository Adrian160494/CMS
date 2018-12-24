<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 30.10.2018
 * Time: 21:22
 */

namespace App\Http\Form;

class EditPostFormBasic extends Form{
    protected $form_name = 'edit_post_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Tytuł','','label-custom'),
            'input'=>Form::createInput('text','title','','custom-form-input','')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Autor','','label-custom'),
            'input'=>Form::createInput('text','author','','custom-form-input','')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Kategoria','','label-custom'),
            'input'=>Form::createSelect('category','custom-form-input','',''),
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Plik','','label-custom'),
            'input'=>Form::createFile('file','file','Dodaj zdjęcie główne','custom-form-input','')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Dodaj','','btn-1 btn-long','')
        ));

        return self::$form_elements;
    }

}