<?php

namespace  Autorizacionsar\Model;

use RuntimeException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGatewayInterface;


class AutorizacionsarTable
{
     private $AutorizacionsartableGateway;

     public function __construct(TableGatewayInterface $AutorizacionsartableGateway)
     {
               
                $this->tableGateway = $AutorizacionsartableGateway;
     }

     public function fetchAll()
     {
                $sqlSelect = $this->tableGateway->getSql()->select();
                $sqlSelect->columns(array('Cod_Autorizacion','Cai','Consecutivo_Inicial','Consecutivo_Final','Fecha_Limite','Sucursal','Fecha_Ingreso'));
                $sqlSelect->join('Sucursales', 'sucursales.Cod_sucursal = autorizaciones_sar.Sucursal', array('Nombre_Sucursal'), 'left');

                 $resultSet = $this->tableGateway->selectWith($sqlSelect);
                 return $resultSet;
               //return $this->tableGateway->select();
     }


    public function getAuto($Cod_Autorizacion)
     {
                $Cod_Autorizacion = $Cod_Autorizacion;
                $rowset = $this->tableGateway->select(['Cod_Autorizacion' => $Cod_Autorizacion]);
                $row = $rowset->current();
                if (! $row) {
                    return false;
                }
                return $row;
     }
    
  public function saveAuto(Autorizacionsar $autorizacionsar)
     {
            $data = [
                'Cai'  => $autorizacionsar->Cai,
                'Consecutivo_Inicial'  => $autorizacionsar->Consecutivo_Inicial,
                'Consecutivo_Final'  => $autorizacionsar->Consecutivo_Final,
                'Sucursal'  => $autorizacionsar->Sucursal,
                'Fecha_Limite'  => $autorizacionsar->Fecha_Limite,
            ];
           
            $Cod_Autorizacion = (int) $autorizacionsar->Cod_Autorizacion;

            
           if ($Cod_Autorizacion != null) {
               $this->tableGateway->insert($data);
               return;
        
            }

     }
}