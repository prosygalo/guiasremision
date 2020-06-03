<?php

namespace UnidadTransporte\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;


class UnidadTransporte  implements InputFilterAwareInterface
{ 
    public $Cod_Unidad;
    public $Marca_Vehiculo;
    public $Modelo_Vehiculo;
    public $Placa_Vehiculo;
    public $Estado;
    public $Fecha_Ingreso;
    public $Fecha_Actualizacion;
    
   

    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
        $this->Cod_Unidad = !empty($data['Cod_Unidad']) ? $data['Cod_Unidad'] : null;
        $this->Placa_Vehiculo = !empty($data['Placa_Vehiculo']) ? $data['Placa_Vehiculo'] : null;
        $this->Marca_Vehiculo = !empty($data['Marca_Vehiculo']) ? $data['Marca_Vehiculo'] : null;
        $this->Modelo_Vehiculo = !empty($data['Modelo_Vehiculo']) ? $data['Modelo_Vehiculo'] : null;
        $this->Estado = !empty($data['Estado']) ? $data['Estado'] : null;
        $this->Fecha_Ingreso  = !empty($data['Fecha_Ingreso']) ? $data['Fecha_Ingreso'] : null;
        $this->Fecha_Actualizacion = !empty($data['Fecha_Actualizacion']) ? $data['Fecha_Actualizacion'] : null;
       
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
            'name' => 'Cod_Unidad',
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
            'name' => 'Marca_Vehiculo',
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 10,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Marca de vehiculo  es invalida',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Marca de vehiculo es obligatorio y debe contener m&aacute;s de 5 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Marca de vehiculo debe contener menos de 10 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-Z0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato  incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Modelo_Vehiculo',
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 5,
                        'max' => 10,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Modelo de vehiculo  es invalida',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Modelo de vehiculo es obligatorio y debe contener m&aacute;s de 5 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Modelo de vehiculo debe contener menos de 10 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-Z0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Placa_Vehiculo',
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 5,
                        'max' => 10,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Placa de vehiculo  es invalida',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Placa de vehiculo es obligatorio y debe contener m&aacute;s de 5 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Placa de vehiculo debe contener menos de 10 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-Z0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato  incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return [
            'Cod_Unidad' => $this->Cod_Unidad,
            'Marca_Vehiculo' => $this->Marca_Vehiculo,
            'Modelo_Vehiculo' => $this->Modelo_Vehiculo,
            'Placa_Vehiculo' => $this->Placa_Vehiculo,
            'Estado' => $this->Estado,
            'Fecha_Ingreso'=>$this->Fecha_Ingreso,
            'Fecha_actualizacion'=>$this->Fecha_Actualizacion,
        ];
    }
    
}

