<?php

namespace Boletasremision\Model;

use RuntimeException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGatewayInterface;

class DetalleTable
{
    private $DetalleTableGateway;

     public function __construct(TableGatewayInterface $DetalleTableGateway)
     {
               
            $this->DetalleTableGateway = $DetalleTableGateway;
     }

     public function fetchAll()
     {

        return $this->DetalleTableGateway->select();
     }

    public function getDetalle($Cod_Detalle)
     {
        $Cod_Detalle = $Cod_Detalle;
            $rowset = $this->DetalleTableGateway->select(['Cod_Detalle' => $Cod_Detalle]);
            $row = $rowset->current();
                if (! $row) {
                    return false;
                }
                return $row;
     }  
   /* public function nsertDetalle(array $data)
     {  
        $data= array()
              
        $this->DetalleTableGateway->insert($data);
            return $data ;        

     }*/
    public function insertDetalle($Cod_Producto, $lasId, $Cantidad)
    {  
        $Cod_Producto = $Cod_Producto;
        $lasId = $lasId;
        $Cantidad = $Cantidad; 
        $data = array();

        for($count = 0; $count < count($Cod_Producto); $count++){           
             $data=[
                'Cod_Producto' =>$Cod_Producto[$count],
                'Cod_Boleta'   =>$lasId,
                'Cantidad'     =>$Cantidad[$count],
            ];
          }
          $this->DetalleTableGateway->insert($data);
           return ;    
    }
}