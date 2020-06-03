<?php

namespace Unidadtransporte\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class UnidadtransporteForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('unidadtransporte');

        $this->add([
            'name' => 'Cod_Unidad',
            'type' => 'text',
            'options' => [
                'label' => 'Código de unidad de transporte',
            ],
        ]);
       
        $this->add([
            'name' => 'Placa_Vehiculo',
            'type' => 'text',
            'options' => [
                'label' => 'Placa de vehículo',
            ],
        ]);

        $this->add([
            'name' => 'Marca_Vehiculo',
            'type' => 'text',
            'options' => [
                'label' => 'Marca de vehículo',
            ],
        ]);
        $this->add([
            'name' => 'Modelo_Vehiculo',
            'type' => 'text',
            'options' => [
                'label' => 'Modelo de vehículo',
            ],
        ]);

         $this->add([
            'type' => Element\Select::class,
            'name' => 'Estado',
            'options' => [
                'label' => 'Estado',
                'empty_option' => 'Seleccione',
                'value_options' => [
                       'Disponible' => 'Disponible',
                       'No disponible' => 'No disponible',
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