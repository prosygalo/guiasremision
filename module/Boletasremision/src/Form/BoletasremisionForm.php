<?php

namespace Boletasremision\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class BoletasremisionForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('boletas');

        $Cod_Boleta = new Element\Text('Cod_Boleta');
        $Cod_Boleta->setAttribute('type','hidden');
        $this->add($Cod_Boleta);

        $Fecha_Emision = new Element\Text('Fecha_Emision');
        $Fecha_Emision->setAttribute('type','text');
        $Fecha_Emision->setLabel("Fecha de Emisión");
        $Fecha_Emision->setAttribute('class', 'form-control autofocus');
        $Fecha_Emision->setAttribute('readonly', 'readonly');
        $this->add($Fecha_Emision);

        $Consecutivo_Actual_Establ = new Element\Text('Consecutivo_Actual_Establ');
        $Consecutivo_Actual_Establ->setAttribute('class', 'form-control');
        $Consecutivo_Actual_Establ->setLabel("Establ");
        $Consecutivo_Actual_Establ->setAttribute('placeholder', '000');
        $Consecutivo_Actual_Establ->setAttribute('readonly', 'readonly');
        $this->add($Consecutivo_Actual_Establ);
        
        $Consecutivo_Actual_Punto = new Element\Text('Consecutivo_Actual_Punto');
        $Consecutivo_Actual_Punto->setAttribute('class', 'form-control');
        $Consecutivo_Actual_Punto->setLabel("Punto");
        $Consecutivo_Actual_Punto->setAttribute('placeholder', '000');
        $Consecutivo_Actual_Punto->setAttribute('readonly', 'readonly');
        $this->add($Consecutivo_Actual_Punto);

        $Consecutivo_Actual_Tipo = new Element\Text('Consecutivo_Actual_Tipo');
        $Consecutivo_Actual_Tipo->setAttribute('class', 'form-control');
        $Consecutivo_Actual_Tipo->setLabel("Tipo");
        $Consecutivo_Actual_Tipo->setAttribute('placeholder', '00');
        $Consecutivo_Actual_Tipo->setAttribute('readonly', 'readonly');
        $this->add($Consecutivo_Actual_Tipo);

        $Consecutivo_Actual_Correlativo = new Element\Text('Consecutivo_Actual_Correlativo');
        $Consecutivo_Actual_Correlativo->setAttribute('class', 'form-control');
        $Consecutivo_Actual_Correlativo->setLabel("Correlativo");
        $Consecutivo_Actual_Correlativo->setAttribute('placeholder', '00000000');
        $Consecutivo_Actual_Correlativo->setAttribute('readonly', 'readonly');
        $this->add($Consecutivo_Actual_Correlativo);


       $this->add([
            'name' => 'Motivo_Traslado',
            'type' => 'text',
            'options' => [
                'label' => 'Motivo de traslado',
            ],
        ]);

       $this->add([
            'name' => 'Num_Transferencia',
            'type' => 'text',
            'options' => [
                'label' => 'Número de transferencia',
            ],
        ]);

       $this->add([
            'name' => 'Punto_Partida',
            'type' => 'text',
            'options' => [
                'label' => 'Punto de partida',
            ],
        ]);

       $this->add([
            'name' => 'Punto_Destino',
            'type' => 'text',
            'options' => [
                'label' => 'Punto de destino',
            ],
        ]);

       $this->add([
            'name' => 'Fecha_Inicio_Traslado',
            'type' => 'date',
            'options' => [
                'label' => 'Fecha inicio de traslado',
                'format' => 'Y-m-d',
            ],
            'attributes' => [
            'min' => '2020-01-01',
            'max' => '2030-01-01',
           ],
        ]);

       $this->add([
            'name' => 'Fecha_Final_Traslado',
            'type' => 'date',
            'options' => [
                'label' => 'Fecha final de traslado',
                'format' => 'Y-m-d',
            ],
            'attributes' => [
            'min' => '2020-01-01',
            'max' => '2030-01-01',
           ],
        ]);

        $this->add([
            'name' => 'Autorizacion_Sar',
            'type' => 'text',
            'options' => [
                'label' => 'Código de Autorización SAR',
            ],
        ]);

         $this->add([
            'name' => 'Usuario',
            'type' => 'text',
             'options' => [
                'label' => 'Usuario',
            ],
        ]);
        
        $productos = new Element\Select('productos');
        $productos->setAttribute('id', 'pro_id');
        $productos->setAttribute('data-width', '100%');
        $productos->setAttribute('data-live-search', 'true');
        $productos->setAttribute('class', 'form-control selectpicker  pro_id'); 
        $this->add($productos);
        
        $Sucursal = new Element\Select('Sucursal');
        $Sucursal->setAttribute('name', 'Sucursal');
        $Sucursal->setAttribute('id', 'Sucursal');
        $Sucursal->setLabel('Sucursal');
        $Sucursal->setEmptyOption('Seleccione');
        $Sucursal->setAttribute('class', 'form-control');
        $this->add($Sucursal);
           

        $Unidad_Transporte = new Element\Select('Unidad_Transporte');
        $Unidad_Transporte->setAttribute('name', 'Unidad_Transporte');
        $Unidad_Transporte->setAttribute('id', 'Unidad_Transporte');
        $Unidad_Transporte->setLabel('Unidad de Transporte');
        $Unidad_Transporte->setAttribute('class', 'form-control autofocus');
        $Unidad_Transporte->setEmptyOption('Seleccione'); 
        $this->add($Unidad_Transporte);

        $Conductor = new Element\Select('Conductor');
        $Conductor->setAttribute('name', 'Conductor');
        $Conductor->setAttribute('id', 'Conductor');
        $Conductor->setLabel('Conductor');
        $Conductor->setEmptyOption('Seleccione');
        $Conductor->setAttribute('class', 'form-control'); 
        $this->add($Conductor);

        $Cod_Detalle = new Element\Text('Cod_Detalle');
        $Cod_Detalle->setAttribute('type','hidden');
        $this->add($Cod_Detalle);

        $Cod_Producto = new Element\Text('Cod_Producto');
        $Cod_Producto->setAttribute('Id','Cod_Producto');
        $Cod_Producto->setAttribute('type','text');
        $Cod_Producto->setAttribute('class', 'form-control');
        //$Cod_Producto->setAttribute('readonly', 'readonly');
        $this->add($Cod_Producto);

        $Cantidad= new Element\Text('Cantidad');
        $Cantidad->setAttribute('Id','Cantidad');
        $Cantidad->setAttribute('type','text');
        $Cantidad->setAttribute('class', 'form-control');
        $Cantidad->setValue('1');
        $Cantidad->setAttribute('onkeypress',"return int(event)");
        $this->add($Cantidad);


        $Agregar = new Element\Button('Agregar');
        $Agregar->setLabel("Agregar  productos a la lista");
        $Agregar->setAttribute('type','button');
        $Agregar->setAttribute('class', 'btn btn-success btn-block');
        $Agregar->setAttribute('data-toggle', 'modal');
        $Agregar->setAttribute('data-target', '#myModal');
        $this->add($Agregar);

        $submit = new Element\Button('submit');
        $submit->setLabel("Guardar");
        $submit->setAttribute('type','button');
        $submit->setAttribute('id','submit');
        $submit->setAttribute('class', 'btn btn-primary btn-block');
       // $submit->setAttribute('disabled','disabled');

        $this->add($submit);

     }
}