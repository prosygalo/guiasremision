<?php

namespace Producto\Entity;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;


class Producto   implements InputFilterAwareInterface
{ 
    public $Id;
    public $Cod_Producto;
    public $Nombre;
    public $Descripcion;
    public $Fecha_Ingreso;
    public $Fecha_Actualizacion;


    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
        $this->Id     = !empty($data['Id']) ? $data['Id'] : null;
        $this->Cod_Producto = !empty($data['Cod_Producto']) ? $data['Cod_Producto'] : null;
        $this->Nombre = !empty($data['Nombre']) ? $data['Nombre'] : null;
        $this->Descripcion = !empty($data['Descripcion']) ? $data['Descripcion'] : null;
        $this->Fecha_Ingreso  = !empty($data['Fecha_Ingreso']) ? $data['Fecha_Ingreso'] : null;
        $this->Fecha_Actualizcion  = !empty($data['Fecha_Actualizacion']) ? $data['Fecha_Actualizacion'] : null;
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
            'name' => 'Id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Cod_Producto',
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
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de c&oacute;digo incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Nombre',
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
            'name' => 'Descripcion',
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
                        'max' => 100,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Descripci&acute;on es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Descripci&oacute;n es obligatorio y  debe contener m&aacute;s de 4 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Descripci&oacute;n debe contener menos de 100 car&aacute;cteres',
                        ]
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
            'Id' => $this->Id,
            'Cod_Producto' => $this->Cod_Producto,
            'Nombre' => $this->Nombre,
            'Descripcion'  => $this->Descripcion,
            'Fecha_Ingreso'=>$this->Fecha_Ingreso,
            'Fecha_actualizacion'=>$this->Fecha_Actualizacion,
        ];
    }
    
}

