<?php

namespace Producto\Model;

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
    public $Cod_Producto;
    public $Nombre_Producto;
    public $Descripcion;
    public $Fecha_Ingreso;
    public $Fecha_Actualizacion;


    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
    
        $this->Cod_Producto = !empty($data['Cod_Producto']) ? $data['Cod_Producto'] : null;
        $this->Nombre_Producto = !empty($data['Nombre_Producto']) ? $data['Nombre_Producto'] : null;
        $this->Descripcion = !empty($data['Descripcion']) ? $data['Descripcion'] : null;
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
            'name' => 'Nombre_Producto',
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
                       'pattern' => '/^[a-z\d\-_\s]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato incorrecto',
            
                      ],
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
                        'min' => 2,
                        'max' => 100,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Descripci&acute;on es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Descripci&oacute;n es obligatorio y  debe contener m&aacute;s de 2 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Debe contener menos de 100 car&aacute;cteres',
                        ]
                    ],
            
                ],
               ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato incorrecto',
            
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
            'Cod_Producto' => $this->Cod_Producto,
            'Nombre_Producto' => $this->Nombre_Producto,
            'Descripcion'  => $this->Descripcion,
            'Fecha_Ingreso'=>$this->Fecha_Ingreso,
            'Fecha_Actualizacion'=>$this->Fecha_Actualizacion,
        ];
    }
    
}

