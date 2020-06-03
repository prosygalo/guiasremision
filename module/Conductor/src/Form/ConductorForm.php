<?php

namespace Conductor\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class ConductorForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('conductor');

        $this->add([
            'name' => 'Cod_Conductor',
            'type' => 'text',
            'options' => [
                'label' => 'Código de conductor',
            ],
        ]);

        
        $this->add([
            'name' => 'Nombres_Conductor',
            'type' => 'text',
            'options' => [
                'label' => 'Nombres',
            ],
        ]);

          $this->add([
            'name' => 'Apellidos_Conductor',
            'type' => 'text',
            'options' => [
                'label' => 'Apellidos',
            ],
        ]);
         $this->add([
            'name' => 'Rtn',
            'type' => 'text',
            'options' => [
                'label' => 'RTN',
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