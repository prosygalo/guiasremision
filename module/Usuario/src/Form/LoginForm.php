<?php
namespace Usuario\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/**
 * Este formulario se utiliza para recopilar el nombre de usuario, la contraseña y la bandera "Recordarme".
 */
class LoginForm extends Form
{ 
    /**
     * Constructor.     
     */
    public function __construct($name = null)
    {
        // Define el nombre del formulario 
        parent::__construct('login');

        //Agregar campo Correo
        $this->add([
            'name' => 'Correo',
            'type' => 'text',
            'options' => [
                'label' => 'Correo electrónico',
            ],
        ]);

        //Agregar campo Clave
        $this->add([
            'name' => 'Clave',
            'type' => 'Password',
            'options' => [
                'label' => 'Contraseña',

            ],
            'attributes' => [
                'id'    => 'Clave',
            ],
        ]);

        //Agregar campo  submit
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