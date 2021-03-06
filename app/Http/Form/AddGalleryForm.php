<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 30.10.2018
 * Time: 21:22
 */

namespace App\Http\Form;

class AddGalleryForm extends Form{
    protected $form_name = 'cms_gallery_dodaj_form';
    protected static $form_elements = array();

    public static function prepareForm(){
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Nazwa','','label-custom'),
            'input'=>Form::createInput('text','name','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'label'=>Form::createLabel('Aktywność','','label-custom'),
            'input'=>Form::createInput('checkbox','is_active','','custom-form-input')
        ));
        array_push(self::$form_elements,array(
            'input'=>Form::createInput('submit','Zapisz','','btn-1 btn-long','Zapisz')
        ));

        return self::$form_elements;
    }

}