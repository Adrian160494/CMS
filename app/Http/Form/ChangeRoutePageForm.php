<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 31.10.2018
 * Time: 23:00
 */

namespace App\Http\Form;

class ChangeRoutePageForm extends Form{
    protected $form_name = 'change_route_page_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('text','route','','custom-form-input','','Route')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Zmień','','btn-1 btn-long','Zapisz')
        ));

        return self::$form_elements;
    }

}