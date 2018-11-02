<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 30.10.2018
 * Time: 21:22
 */

namespace App\Http\Form;

class ChooseProjectForm extends Form{
    protected $form_name = 'choose_project_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Projekt','','label-custom'),
            'input'=>Form::createSelect('select','custom-form-select','','')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Pokaż','','btn-1 btn-long','Pokaż')
        ));

        return self::$form_elements;
    }

}