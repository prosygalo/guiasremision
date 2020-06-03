<?php

namespace Conductor\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;


class Conductor  implements InputFilterAwareInterface
{ 
    public $Cod_Conductor;
    public $Nombres_Conductor;
    public $Apellidos_Conductor;
    public $Rtn;
    public $Fecha_Ingreso;
    public $Fecha_Actualizacion;


    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
        $this->Cod_Conductor = !empty($data['Cod_Conductor']) ? $data['Cod_Conductor'] : null;
        $this->Nombres_Conductor = !empty($data['Nombres_Conductor']) ? $data['Nombres_Conductor'] : null;
        $this->Apellidos_Conductor = !empty($data['Apellidos_Conductor']) ? $data['Apellidos_Conductor'] : null;
        $this->Rtn = !empty($data['Rtn']) ? $data['Rtn'] : null;
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
            'name' => 'Cod_Conductor',
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
            'name' => 'Nombres_Conductor',
            'filters' => [
               ['name' => StripTags::class],
              
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 50,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Nombres es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Este campo es obligatorio y debe contener m&aacute;s de 3 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Este campo  debe contener menos de 50 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de nombres incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'Apellidos_Conductor',
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
                        \Zend\Validator\StringLength::TOO_SHORT=>'Este campo es obligatorio y debe contener m&aacute;s de 3 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Este campo  debe contener menos de 50 car&aacute;cteres',
                        ]
                    ],
                ],
                ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de apellidos incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

          $inputFilter->add([
            'name' => 'Rtn',
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


        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return [
            'Cod_Conductor' => $this->Cod_Conductor,
            'Nombres_Conductor' => $this->Nombres_Conductor,
            'Apellidos_Conductor' => $this->Apellidos_Conductor,
            'Rtn'=>$this->Rtn,
            'Fecha_Ingreso'=>$this->Fecha_Ingreso,
            'Fecha_Actualizacion'=>$this->Fecha_Actualizacion,
        ];
    }
    
}

