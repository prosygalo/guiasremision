<?php

namespace Autorizacionsar\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class AutorizacionsarForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('autorizacionsar');

        $this->add([
            'name' => 'Cod_Autorizacion',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'Cai',
            'type' => 'text',
            'options' => [
                'label' => 'Clave de autorización de impresión (C.A.I.)',
            ],
        ]);

        $this->add([
            'name' => 'Consecutivo_Inicial',
            'type' => 'text',
            'options' => [
                'label' => 'Consecutivo Inicial',
            ],
        ]);
        
        $this->add([
            'name' => 'Consecutivo_Final',
            'type' => 'text',
            'options' => [
                'label' => 'Consecutivo Final',
            ],
        ]);

        $this->add([
            'type' => 'select',
            'name' => 'Sucursal',
            'options' => [
                'label' => 'Sucursal',
                'empty_option' => 'Seleccione',
                'value_options' => [
                       'M89' => 'N°1 Tegucigalpa',
                       'M98' => 'N°2 SAn Pedro Sula',
               ],
             ],
        ]);

        $this->add([
            'name' => 'Fecha_Limite',
            'type' => 'date',
            //'id' =>'Fecha_Limite',
            'options' => [
                'label' => 'Fecha Límite de emisión',
                'format' => 'Y-m-d',
            ],
            'attributes' => [
            'min' => '2020-01-01',
            'max' => '2030-01-01',
           ],
        ]);
    
         $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}