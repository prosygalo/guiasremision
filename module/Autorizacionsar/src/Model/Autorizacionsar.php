<?php

namespace Autorizacionsar\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;
use Zend\Validator\Date;



class Autorizacionsar  implements InputFilterAwareInterface
{ 
    public $Cod_Autorizacion;
    public $Cai;
    public $Consecutivo_Inicial;
    public $Consecutivo_Final;
    public $Sucursal;
    public $Fecha_Limite;
    public $Fecha_Ingreso;

    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
        $this->Cod_Autorizacion = !empty($data['Cod_Autorizacion']) ? $data['Cod_Autorizacion'] : null;
        $this->Cai = !empty($data['Cai']) ? $data['Cai'] : null;
        $this->Consecutivo_Inicial = !empty($data['Consecutivo_Inicial']) ? $data['Consecutivo_Inicial'] : null;
        $this->Consecutivo_Final = !empty($data['Consecutivo_Final']) ? $data['Consecutivo_Final'] : null;  
        $this->Sucursal = !empty($data['Sucursal']) ? $data['Sucursal'] : null;
        $this->Fecha_Limite = !empty($data['Fecha_Limite']) ? $data['Fecha_Limite'] : null;
        $this->Fecha_Ingreso  = !empty($data['Fecha_Ingreso']) ? $data['Fecha_Ingreso'] : null;

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
            'name' => 'Cod_Autorizacion',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
             ],
           ]);

        $inputFilter->add([
            'name' => 'Cai',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 37,
                        'max' => 37,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'CAI es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'CAI debe contener 36 car&aacute;cteres alfanuméricos',
                        \Zend\Validator\StringLength::TOO_LONG=>'CAI debe contener máximo 36 car&aacute;cteres alfanuméricos',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-Z0-9_-]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de CAI incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);

        

        $inputFilter->add([
            'name' => 'Consecutivo_Inicial',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 6,
                        'max' => 15,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Consecutivo Inicial   incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Consecutivo Inicial es obligatorio y debe contener 6 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Consecutivo Inicial debe contener 15 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9_-]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de Consecutivo incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);

        $inputFilter->add([
            'name' => 'Consecutivo_Final',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 6,
                        'max' => 15,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Consecutivo Final es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Consecutivo Final es obligatorio y debe contener 6 car&aacute;cteres como mínimo',
                        \Zend\Validator\StringLength::TOO_LONG=>'Consecutivo Final debe contener 15 car&aacute;cteres como máximo',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9_-]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de Consecutivo incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);

        

        $inputFilter->add([
            'name' => 'Sucursal',
            'required' => true,
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
            'name' => 'Fecha_Limite',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               //['name' => StringTrim::class],
               ],
             'validators' => [
                      ['name' => StringLength::class,
                        'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 10,
                        'max' => 10,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Fecha es incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Fecha Límite es obligatorio y  debe tener  10 Caracteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Fecha Límite debe tener 10 Caracteres',
                         ],
                       ],
                    ], 
                    ['name'=>date::class,
                      'options'=>[
                      'format' => 'Y-m-d',
                      'messages' => [
                        \Zend\Validator\date::INVALID=>'Fecha limite no válida',
                        \Zend\Validator\date::INVALID_DATE=>'Fecha Límite es obligatorio y  debe tener  10 Caracteres',
                        \Zend\Validator\date::FALSEFORMAT=>'Formato de fecha incorrecto',
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
            'Cod_Autorizacion' => $this->Cod_Autorizacion,
            'Cai' => $this->Cai,
            'Consecutivo_Inicial'=>$this->Consecutivo_Inicial,
            'Consecutivo_Final'=>$this->Consecutivo_Final,
            'Sucursal' => $this->Sucursal,
            'Fecha_Limite'=>$this->Fecha_Limite,
            'Fecha_Ingreso'=>$this->Fecha_Ingreso,
        ];
    }
    
}

