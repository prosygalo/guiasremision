<?php

namespace Departamento\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;


class Departamento  implements InputFilterAwareInterface
{ 
    public $Cod_Departamento;
    public $Nombre_Depto;
    public $Sucursal;
    public $Fecha_Ingreso;
    public $Fecha_Actualizacion;
    public $Cod_Sucursal;
    public $Nombre_Sucursal;

    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
        $this->Cod_Departamento = !empty($data['Cod_Departamento']) ? $data['Cod_Departamento'] : null;
        $this->Nombre_Depto = !empty($data['Nombre_Depto']) ? $data['Nombre_Depto'] : null;
        $this->Sucursal = !empty($data['Sucursal']) ? $data['Sucursal'] : null;
        $this->Fecha_Ingreso  = !empty($data['Fecha_Ingreso']) ? $data['Fecha_Ingreso'] : null;
        $this->Fecha_Actualizacion = !empty($data['Fecha_Actualizacion']) ? $data['Fecha_Actualizacion'] : null;
        $this->Cod_Sucursal = !empty($data['Cdo_Sucursal']) ? $data['Cod_Sucursal'] : null;
        $this->Nombre_Sucursal = !empty($data['Nombre_Sucursal']) ? $data['Nombre_Sucursal'] : null;
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
            'name' => 'Cod_Departamento',
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
            'name' => 'Nombre_Depto',
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
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato  incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Sucursal',
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

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return [
            'Cod_Departamento' => $this->Cod_Departamento,
            'Nombre_Depto' => $this->Nombre_Depto,
            'Sucursal' => $this->Sucursal,
            'Fecha_Ingreso'=>$this->Fecha_Ingreso,
            'Fecha_actualizacion'=>$this->Fecha_Actualizacion,
        ];
    }
    
}

