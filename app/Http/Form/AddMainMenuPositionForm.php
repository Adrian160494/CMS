<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 31.10.2018
 * Time: 23:00
 */

namespace App\Http\Form;

class AddMainMenuPositionForm extends Form{
    protected $form_name = 'add_main_menu_position_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('hidden','id_menu','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('hidden','id_parent_submenu','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Nazwa','','label-custom'),
            'input'=>Form::createInput('text','nazwa','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Submenu','','label-custom'),
            'input'=>Form::createInput('checkbox','czy_submenu','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Strona','','label-custom'),
            'input'=>Form::createSelect('url','custom-form-input','','')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Url','','label-custom'),
            'input'=>Form::createInput('text','url','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','submit','','btn-1 btn-long','Zapisz')
        ));

        return self::$form_elements;
    }

}