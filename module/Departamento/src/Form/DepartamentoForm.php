<?php

namespace Departamento\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class DepartamentoForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('departamento');

        $this->add([
            'name' => 'Cod_Departamento',
            'type' => 'text',
            'options' => [
                'label' => 'Código de departamento',
            ],
        ]);
       
        $this->add([
            'name' => 'Nombre_Depto',
            'type' => 'text',
            'options' => [
                'label' => 'Nombre',
            ],
        ]);


        $this->add([
            'type' => Element\Select::class,
            'name' => 'Sucursal',
            'options' => [
                'label' => 'Sucursal',
                'empty_option' => 'Seleccione',
                'value_options' => [
                       'M89' => 'N°1 Tegucigalpa',
                       'M98' => 'N°2 San Pedro Sula',
               ],
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