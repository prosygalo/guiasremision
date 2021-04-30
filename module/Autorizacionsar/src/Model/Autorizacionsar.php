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
    public $Consecutivo_Inicial_Establ;
    public $Consecutivo_Inicial_Punto;
    public $Consecutivo_Inicial_Tipo;
    public $Consecutivo_Inicial_Correlativo;
    public $Consecutivo_Final_Establ;
    public $Consecutivo_Final_Punto;
    public $Consecutivo_Final_Tipo;
    public $Consecutivo_Final_Correlativo;
    public $Consecutivo_Actual_Establ;
    public $Consecutivo_Actual_Punto;
    public $Consecutivo_Actual_Tipo;
    public $Consecutivo_Actual_Correlativo;
    public $Sucursal;
    public $Fecha_Limite;
    public $Fecha_Ingreso;

    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
        $this->Cod_Autorizacion = !empty($data['Cod_Autorizacion']) ? $data['Cod_Autorizacion'] : null;
        $this->Cai = !empty($data['Cai']) ? $data['Cai'] : null;
        $this->Consecutivo_Inicial_Establ = !empty($data['Consecutivo_Inicial_Establ']) ? $data['Consecutivo_Inicial_Establ'] : null;
        $this->Consecutivo_Inicial_Punto = !empty($data['Consecutivo_Inicial_Punto']) ? $data['Consecutivo_Inicial_Punto'] : null;
        $this->Consecutivo_Inicial_Tipo = !empty($data['Consecutivo_Inicial_Tipo']) ? $data['Consecutivo_Inicial_Tipo'] : null;
        $this->Consecutivo_Inicial_Correlativo = !empty($data['Consecutivo_Inicial_Correlativo']) ? $data['Consecutivo_Inicial_Correlativo'] : null;
        $this->Consecutivo_Final_Establ = !empty($data['Consecutivo_Final_Establ']) ? $data['Consecutivo_Final_Establ'] : null;  
        $this->Consecutivo_Final_Punto = !empty($data['Consecutivo_Final_Punto']) ? $data['Consecutivo_Final_Punto'] : null;  
        $this->Consecutivo_Final_Tipo = !empty($data['Consecutivo_Final_Tipo']) ? $data['Consecutivo_Final_Tipo'] : null;  
        $this->Consecutivo_Final_Correlativo = !empty($data['Consecutivo_Final_Correlativo']) ? $data['Consecutivo_Final_Correlativo'] : null;  
        $this->Consecutivo_Actual_Establ = !empty($data['Consecutivo_Actual_Establ']) ? $data['Consecutivo_Actual_Establ'] : null;
         $this->Consecutivo_Actual_Punto = !empty($data['Consecutivo_Actual_Punto']) ? $data['Consecutivo_Actual_Punto'] : null;
          $this->Consecutivo_Actual_Tipo = !empty($data['Consecutivo_Actual_Tipo']) ? $data['Consecutivo_Actual_Tipo'] : null;
           $this->Consecutivo_Actual_Correlativo = !empty($data['Consecutivo_Actual_Correlativo']) ? $data['Consecutivo_Actual_Correlativo'] : null;  
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
                        'min' => 36,
                        'max' => 36,
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
            'name' => 'Consecutivo_Inicial_Establ',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 3,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Establ   incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Establ es obligatorio y debe contener 3 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Establ debe contener 3 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Establ de Consecutivo incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
        $inputFilter->add([
            'name' => 'Consecutivo_Inicial_Punto',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 3,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Punto   incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Punto es obligatorio y debe contener 3 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Punto debe contener 3 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Punto es incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
         $inputFilter->add([
            'name' => 'Consecutivo_Inicial_Tipo',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 2,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Tipo   incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Tipo es obligatorio y debe contener 2 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Tipo debe contener 2 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Tipo es incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
         $inputFilter->add([
            'name' => 'Consecutivo_Inicial_Correlativo',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' =>8 ,
                        'max' =>8,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Correlativo  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Correlativo es obligatorio y debe contener 8 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Correlativo debe contener 8 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Correlativo es incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);



       $inputFilter->add([
            'name' => 'Consecutivo_Final_Establ',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 3,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Establ   incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Establ es obligatorio y debe contener 3 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Establ debe contener 3 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Establ de Consecutivo incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
       $inputFilter->add([
            'name' => 'Consecutivo_Final_Punto',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 3,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Punto   incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Punto es obligatorio y debe contener 3 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Punto debe contener 3 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Punto es incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
       $inputFilter->add([
            'name' => 'Consecutivo_Final_Tipo',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 2,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Tipo   incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Tipo es obligatorio y debe contener 2 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Tipo debe contener 2 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Tipo es incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
       $inputFilter->add([
            'name' => 'Consecutivo_Final_Correlativo',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' =>8 ,
                        'max' =>8,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Correlativo  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Correlativo es obligatorio y debe contener 8 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Correlativo debe contener 8 car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Correlativo es incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
        
         /*$inputFilter->add([
            'name' => 'Consecutivo_Actual_Establ',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
             ],
           ]);
          $inputFilter->add([
            'name' => 'Consecutivo_Actual_Punto',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
             ],
           ]); $inputFilter->add([
            'name' => 'Consecutivo_Actual_Tipo',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
             ],
           ]); $inputFilter->add([
            'name' => 'Consecutivo_Actual_Correlativo',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
             ],
           ]);*/

        

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
            'Consecutivo_Inicial_Establ'=>$this->Consecutivo_Inicial_Establ,
            'Consecutivo_Inicial_Punto'=>$this->Consecutivo_Inicial_Punto,
            'Consecutivo_Inicial_Tipo'=>$this->Consecutivo_Inicial_Tipo,
            'Consecutivo_Inicial_Correlativo'=>$this->Consecutivo_Inicial_Correlativo,
            'Consecutivo_Final_Establ'=>$this->Consecutivo_Final_Establ,
            'Consecutivo_Final_Punto'=>$this->Consecutivo_Final_Punto,
            'Consecutivo_Final_Tipo'=>$this->Consecutivo_Final_Tipo,
            'Consecutivo_Final_Correlativo'=>$this->Consecutivo_Final_Correlativo,
            'Consecutivo_Actual_Establ'=>$this->Consecutivo_Actual_Establ,
            'Consecutivo_Actual_Punto'=>$this->Consecutivo_Actual_Punto,
            'Consecutivo_Actual_Tipo'=>$this->Consecutivo_Actual_Tipo,
            'Consecutivo_Actual_Correlativo'=>$this->Consecutivo_Actual_Correlativo,
            'Sucursal' => $this->Sucursal,
            'Fecha_Limite'=>$this->Fecha_Limite,
            'Fecha_Ingreso'=>$this->Fecha_Ingreso,
        ];
    }
    
}

