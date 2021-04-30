<?php

namespace Boletasremision\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Regex;
use Zend\Validator\date;
use Zend\Validator\EmailAddress;


class Boletasremision implements InputFilterAwareInterface
{ 
    public $Cod_Boleta;
    public $Fecha_Emision;
    public $Consecutivo_Actual_Establ;
    public $Consecutivo_Actual_Punto;
    public $Consecutivo_Actual_Tipo;
    public $Consecutivo_Actual_Correlativo;
    public $Motivo_Traslado;
    public $Num_Transferencia;
    public $Punto_Partida;
    public $Punto_Destino;
    public $Fecha_Inicio_Traslado;
    public $Fecha_Final_Traslado;
    public $Autorizacion_Sar;
    public $Sucursal;
    public $Unidad_Transporte;
    public $Conductor;
    public $Fecha_Ingreso;
    public $Usuario;
    public $Cod_Detalle;
    public $Cod_Producto;
    public $Cantidad;
  
   
    // Add this property:
    private $inputFilter;

    public function exchangeArray(array $data)
    {   
        $this->Cod_Boleta = !empty($data['Cod_Boleta']) ? $data['Cod_Boleta'] : null;
        $this->Fecha_Emision = !empty($data['Fecha_Emision']) ? $data['Fecha_Emision'] : null;
        $this->Consecutivo_Actual_Establ = !empty($data['Consecutivo_Actual_Establ']) ? $data['Consecutivo_Actual_Establ'] : null;
        $this->Consecutivo_Actual_Punto = !empty($data['Consecutivo_Actual_Punto']) ? $data['Consecutivo_Actual_Punto'] : null;
        $this->Consecutivo_Actual_Tipo = !empty($data['Consecutivo_Actual_Tipo']) ? $data['Consecutivo_Actual_Tipo'] : null;
        $this->Consecutivo_Actual_Correlativo = !empty($data['Consecutivo_Actual_Correlativo']) ? $data['Consecutivo_Actual_Correlativo'] : null;
        $this->Motivo_Traslado = !empty($data['Motivo_Traslado']) ? $data['Motivo_Traslado'] : null;
        $this->Num_Transferencia= !empty($data['Num_Transferencia']) ? $data['Num_Transferencia'] : null;
        $this->Punto_Partida = !empty($data['Punto_Partida']) ? $data['Punto_Partida'] : null;
        $this->Punto_Destino = !empty($data['Punto_Destino']) ? $data['Punto_Destino'] : null;
        $this->Fecha_Inicio_Traslado = !empty($data['Fecha_Inicio_Traslado']) ? $data['Fecha_Inicio_Traslado'] : null;
        $this->Fecha_Final_Traslado = !empty($data['Fecha_Final_Traslado']) ? $data['Fecha_Final_Traslado'] : null;
        $this->Autorizacion_Sar = !empty($data['Autorizacion_Sar']) ? $data['Autorizacion_Sar'] : null;
        $this->Sucursal = !empty($data['Sucursal']) ? $data['Sucursal'] : null;
        $this->Unidad_Transporte = !empty($data['Unidad_Transporte']) ? $data['Unidad_Transporte'] : null;
        $this->Conductor = !empty($data['Conductor']) ? $data['Conductor'] : null;
        $this->Fecha_Ingreso = !empty($data['Fecha_Ingreso']) ? $data['Fecha_Ingreso'] : null;
        $this->Usuario = !empty($data['Usuario']) ? $data['Usuario'] : null;
        //Propiedades de otras tablegateway
        $this->Nombre_Sucursal = !empty($data['Nombre_Sucursal']) ? $data['Nombre_Sucursal'] : null;
        $this->Cod_Detalle = !empty($data['Cod_Detalle']) ? $data['Cod_Detalle'] : null;
        $this->Cod_Producto = !empty($data['Cod_Producto']) ? $data['Cod_Producto'] : null;
        $this->Cantidad= !empty($data['Cantidad']) ? $data['Cantidad'] : null;
        
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
            'name' => 'Cod_Boleta',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
             ],
        ]);

        $inputFilter->add([
            'name' => 'Fecha_Emision',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
               ],
             'validators' => [
                    ['name'=>date::class,
                      'options'=>[
                      'format' => 'Y-m-d',
                      'messages' => [
                        \Zend\Validator\date::INVALID=>'Fecha emisión no válida',
                        \Zend\Validator\date::INVALID_DATE=>'Fecha emisión es obligatorio y  debe tener  10 Caracteres',
                        \Zend\Validator\date::FALSEFORMAT=>'Formato de fecha incorrecto',
                         ],
                      ],

                    ],              
                ],
        ]);

       $inputFilter->add([
            'name' => 'Consecutivo_Actual_Establ',
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
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
       $inputFilter->add([
            'name' => 'Consecutivo_Actual_Punto',
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
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato es incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
       $inputFilter->add([
            'name' => 'Consecutivo_Actual_Tipo',
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
                        \Zend\Validator\StringLength::TOO_SHORT=>'Tipo es obligatorio',
                        \Zend\Validator\StringLength::TOO_LONG=>'Tipo debe contener dos car&aacute;cteres',
                        ]
                    ],
                ],
                 ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);
       $inputFilter->add([
            'name' => 'Consecutivo_Actual_Correlativo',
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
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato incorrecto',
            
                      ],
                    ],
                ],
            ],

        ]);

     $inputFilter->add([
            'name' => 'Motivo_Traslado',
            'required' => true,
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
                        \Zend\Validator\StringLength::INVALID=>'Motivo de traslado es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Motivo traslado debe contener m&aacute;s de 3 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Motivo de traslado  debe contener menos de 50 car&aacute;cteres',
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
       
        $inputFilter->add([
            'name' => 'Num_Transferencia',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               //['name' => StringTrim::class],
               ],
             'validators' => [
                       ['name' => StringLength::class,
                        'options' => [
                        'encoding' => 'UTF-8',
                        //'min' => 1,
                        'max' => 10,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Número de transferencia es incorrecto',
                        //\Zend\Validator\StringLength::TOO_SHORT=>'Número de transferencia  es obligatorio',
                        \Zend\Validator\StringLength::TOO_LONG=>'Número de transferencia  debe tener menos de 10 dígitos',
                         ],
                       ],
                      ],
                     ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);
        
         $inputFilter->add([
            'name' => 'Punto_Partida',
            'required' => true,
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
                        \Zend\Validator\StringLength::INVALID=>'Punto de artida es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Punto de partida es obligatorio y  debe contener m&aacute;s de 4 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Punto pde artida  debe contener menos de 200 car&aacute;cteres',
                        ]
                    ],
            
                ],
            ],
        ]);
          $inputFilter->add([
            'name' => 'Punto_Destino',
            'required' => true,
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
                        \Zend\Validator\StringLength::INVALID=>'Punto de destino es  incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Punto de destino es obligatorio y  debe contener m&aacute;s de 4 car&aacute;cteres',
                        \Zend\Validator\StringLength::TOO_LONG=>'Punto de destino debe contener menos de 200 car&aacute;cteres',
                        ]
                    ],
            
                ],
            ],
        ]);

          $inputFilter->add([
            'name' => 'Fecha_Inicio_Traslado',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               //['name' => StringTrim::class],
               ],
             'validators' => [ 
                    ['name'=>date::class,
                      'options'=>[
                      'format' => 'Y-m-d',
                      'messages' => [
                        \Zend\Validator\date::INVALID=>'Fecha  no válida',
                        \Zend\Validator\date::INVALID_DATE=>'Fecha es obligatorio y  debe tener  10 Caracteres',
                        \Zend\Validator\date::FALSEFORMAT=>'Formato de fecha incorrecto',
                         ],
                      ],

                    ],              
                ],
        ]);

          $inputFilter->add([
            'name' => 'Fecha_Final_Traslado',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               //['name' => StringTrim::class],
               ],
             'validators' => [
                    ['name'=>date::class,
                      'options'=>[
                      'format' => 'Y-m-d',
                      'messages' => [
                        \Zend\Validator\date::INVALID=>'Fecha  no válida',
                        \Zend\Validator\date::INVALID_DATE=>'Fecha es obligatorio y  debe tener  10 Caracteres',
                        \Zend\Validator\date::FALSEFORMAT=>'Formato de fecha incorrecto',
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
            'name' => 'Autorizacion_Sar',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
             ],
           ]);

          $inputFilter->add([
            'name' => 'Unidad_Transporte',
            'filters' => [
               ['name' => StripTags::class],
               //['name' => StringTrim::class],
               ],
             'validators' => [
                       ['name' => StringLength::class,
                        'options' => [
                        'encoding' => 'UTF-8',
                        //'min' => 3,
                        'max' => 18,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Unidad de transporte es incorrecto',
                        //\Zend\Validator\StringLength::TOO_SHORT=>'Unidad de transportees obligatorio y  debe tener  m&aacute;s de 3 digitos',
                        \Zend\Validator\StringLength::TOO_LONG=>'Unidad de transporte debe tener menos de 18 digitos',
                         ],
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
            'name' => 'Conductor',
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
                        \Zend\Validator\StringLength::INVALID=>'Conductor es incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Conductores obligatorio y  debe tener  m&aacute;s de 3 digitos',
                        \Zend\Validator\StringLength::TOO_LONG=>'Conductor debe tener menos de 18 digitos',
                         ],
                       ],
                      ],
                     ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-Z0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de Conductor incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);


      /* $inputFilter->add([
            'name' => 'Cod_Producto',
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
                        'max' => 18,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'C&oacute;digo de producto es incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'C&oacute;digo de producto es obligatorio y  debe tener  m&aacute;s de 3 digitos',
                        \Zend\Validator\StringLength::TOO_LONG=>'C&oacute;digo  de producto debe tener menos de 18 digitos',
                         ],
                       ],
                      ],
                     ['name' => Regex::class, 
                     'options' => [
                       'pattern' => '/^[a-zA-Z0-9]+$/',
                       'messages'=>[
                        // \Zend\Validator\Regex::INVALID_CHARACTERS =>'Caracteres invalidos',
                        \Zend\Validator\Regex::NOT_MATCH=>'Formato de c&oacute;digo de producto incorrecto',
            
                      ],
                    ],
                ],
            ],
        ]);
               
        $inputFilter->add([
            'name' => 'Cantidad',
            'required' => true,
            'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
            ],
            'validators' => [
                       ['name' => StringLength::class,
                        'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 18,
                        'messages' => [
                        \Zend\Validator\StringLength::INVALID=>'Cantidad es incorrecto',
                        \Zend\Validator\StringLength::TOO_SHORT=>'Cantidad es obligatorio y  debe tener  m&aacute;s de 1 a 18 digitos',
                        \Zend\Validator\StringLength::TOO_LONG=>'Cantidad excede el número de  digitos aceptados',
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
        ]);*/

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return [
            'Cod_Boleta' => $this->Cod_Boleta,
            'Fecha_Emision' =>$this->Fecha_Emision,
            'Consecutivo_Actual_Establ'  => $this->Consecutivo_Actual_Establ,
            'Consecutivo_Actual_Punto'  => $this->Consecutivo_Actual_Punto,
            'Consecutivo_Actual_Tipo'  => $this->Consecutivo_Actual_Tipo,
            'Consecutivo_Actual_Correlativo'  => $this->Consecutivo_Actual_Correlativo,
            'Motivo_Traslado'  => $this->Motivo_Traslado,
            'Num_Transferencia' => $this->Num_Transferencia,
            'Punto_Partida' => $this->Punto_Partida,
            'Punto_Destino'  => $this->Punto_Destino,
            'Fecha_Inicio_Traslado'  => $this->Fecha_Inicio_Traslado,
            'Fecha_Final_Traslado' => $this->Fecha_Final_Traslado,
            'Autorizacion_Sar' => $this->Autorizacion_Sar,
            'Sucursal' => $this->Sucursal,
            'Unidad_Transporte'  => $this->Unidad_Transporte,
            'Conductor'  => $this->Conductor,
            'Fecha_Ingreso'  => $this->Fecha_Ingreso,
            'Usuario'  => $this->Usuario,
            'Cod_Detalle' => $this->Cod_Detalle,
            'Cod_Producto' => $this->Cod_Producto,
            'Cantidad'  => $this->Cantidad,
          
        ];
    }
    
}
