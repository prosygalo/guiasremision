<?php

namespace Usuario\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class RestablecerForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('registro');

        $this->add([
            'name' => 'Cod_Usuario',
            'type' => 'hidden',   
        ]);
        
         $this->add([
            'name' => 'Clave',
            'type' => 'Password',
            'options' => [
                'label' => 'Contraseña',
            ],
        ]);
         $this->add([
            'name' => 'Confirmarclave',
            'type' => 'Password',
            'options' => [
                'label' => 'Repetir contraseña',
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