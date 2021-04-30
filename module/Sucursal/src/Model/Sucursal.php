<?php

namespace Sucursal\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;
use Zend\Validator\EmailAddress;


class Sucursal   implements InputFilterAwareInterface
{ 
  
    public $Cod_Sucursal;
    public $Nombre_Sucursal;
    public $RTN;
    public $Dirreccion;
    public $Telefono;
    public $Correo;
    public $Fecha_Ingreso;
    public $Fecha_Actualizacion;


    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
        $this->Cod_Sucursal = !empty($data['Cod_Sucursal']) ? $data['Cod_Sucursal'] : null;
        $this->Nombre_Sucursal = !empty($data['Nombre_Sucursal']) ? $data['Nombre_Sucursal'] : null;
        $this->RTN = !empty($data['RTN']) ? $data['RTN'] : null;
        $this->Direccion = !empty($data['Direccion']) ? $data['Direccion'] : null;
        $this->Telefono = !empty($data['Telefono']) ? $data['Telefono'] : null;
        $this->Correo = !empty($data['Correo']) ? $data['Correo'] : null;
        $this->Fecha_Ingreso  = !empty($data['Fecha_Ingreso']) ? $data['Fecha_Ingreso'] : null;
        $this->Fecha_Actualizacion  = !empty($data['Fecha_Actualizacion']) ? $data['Fecha_Actualizacion'] : null;
    }

     public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }
    public function getInputFilter()
    {

        if ($this->inputFilter) {
            return $this->inputFilter;
          }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'Cod_Sucursal',
            'filters' => [
               ['name' => StripTags::class],
               //['name' => StringTrim::class],
               ],
             'validators' => [
                       ['name' => StringLength::class,
                        'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 18,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'C&oacute;digo es incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'C&oacute;digo es obligatorio y  debe tener  m&aacute;s de 3 digitos',
                        \Zend\Validator\StringLength::TOO_LONG=>'C&oacute;digo debe tener menos de 18 digitos',
                         ],
                       ],
                      ],
                     ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-Z0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de c&oacute;digo incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Nombre_Sucursal',
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 50,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Nombre es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Nombre es obligatorio y debe contener m&aacute;s de 3 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Nombre debe contener menos de 50 car&aacute;cteres',
                        ]
                    ],
                ],
            ],
        ]);
         $inputFilter->add([
            'name' => 'RTN',
            'filters' => [
               ['name' => StripTags::class],
               //['name' => StringTrim::class],
               ],
             'validators' => [
                       ['name' => StringLength::class,
                        'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 13,
                        'max' => 13,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'RTN  es incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'RTN es obligatorio y  debe tener 13 d&iacute;gitos',
                        \Zend\Validator\StringLength::TOO_LONG=>'RTN debe tener  13 d&iacute;gitos',
                         ],
                       ],
                      ],
                     ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de RTN incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Direccion',
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 4,
                        'max' => 200,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Direcci&acute;on es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Direcci&acute;on n es obligatorio y  debe contener m&aacute;s de 4 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Direcci&acute;on  debe contener menos de 200 car&aacute;cteres',
                        ]
                    ],
            
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Telefono',
            'filters' => [
               ['name' => StripTags::class],
               //['name' => StringTrim::class],
               ],
             'validators' => [
                       ['name' => StringLength::class,
                        'options' => [
                        'encoding' => 'UTF-8',
                        'min' =>9,
                        'max' =>9,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Tel&eacute;fono  es incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Tel&eacute;fono es obligatorio y  debe tener 9 d&iacute;gitos',
                        \Zend\Validator\StringLength::TOO_LONG=>'Tel&eacute;fono debe tener  9 d&iacute;gitos',
                         ],
                       ],
                      ],
                     ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]{3,4}(-[0-9]{3,4})?$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de tel&eacute;fono incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'Correo',
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 40,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'correo eletr&oacute;nico es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'correo eletr&oacute;nico  es obligatorio',
                        \Zend\Validator\StringLength::TOO_LONG=>'correo  eletr&oacute;nico  debe contener menos de 40 car&aacute;cteres',
                        ]
                    ],
                ],
                [
                    'name' => EmailAddress::class,
                    /*'options' => [
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'correo eletr&oacute;nico',
                        \Zend\Validator\self::INVALID_FORMAT  =>'correo eletr&oacute;nico ',
                        \Zend\Validator\StringLength::TOO_LONG=>'correo  eletr&oacute;nico ',
                        ]
                    ],*/
                ],
            ],
        ]);


        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return [
            'Cod_Sucursal' => $this->Cod_Sucursal,
            'Nombre_Sucursal' => $this->Nombre_Sucursal,
            'RTN'  => $this->RTN,
            'Direccion'  => $this->Direccion,
            'Telefono'  => $this->Telefono,
            'Correo'  => $this->Correo,
            'Fecha_Ingreso'=>$this->Fecha_Ingreso,
            'Fecha_actualizacion'=>$this->Fecha_Actualizacion,
        ];
    }
    
}

