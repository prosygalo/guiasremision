<?php

namespace Departamento\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Sucursal\Model\SucursalTable;


class DepartamentoForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('departamento');

        $this->add([
            'name' => 'Cod_Departamento',
            'type' => 'text',
            'options' => [
                'label' => 'Código de departamento',
            ],
        ]);
       
        $this->add([
            'name' => 'Nombre_Depto',
            'type' => 'text',
            'options' => [
                'label' => 'Nombre',
            ],
        ]);

        /*$this->add([
            'type' => Element\Select::class,
            'name' => 'Sucursal',
            'id'=>'Sucursal',
            'options' => [
                'label' => 'Sucursal',
                'empty_option' => 'Seleccione',
                'value_options' => [
               ],
            ],
        ]);*/

        $Sucursal = new Element\Select('Sucursal');
        $Sucursal->setAttribute('name', 'Sucursal');
        $Sucursal->setAttribute('id', 'Sucursal');
        $Sucursal->setLabel('Sucursal');
        $Sucursal->setEmptyOption('Seleccione'); 
       /*
        $SucursalSelect = new SucursalTable();
        $rowset = $SucursalSelect->getSucursalSelect();
        $Sucursal->setValueOptions($rowset);   
       

         $SucursalSelect = new SucursalTable();
        $rowset = $SucursalSelect->getsucursalselect();
          /*foreach($rowset as $row){
             $Sucursal->setValueOptions([$row->Cod_Sucursal => $row->Nombre_Sucursal]);   
        }*/

        $this->add($Sucursal);

         $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}