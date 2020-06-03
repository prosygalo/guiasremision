<?php

namespace Departamento\Model;

use RuntimeException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGatewayInterface;


class DepartamentoTable
{
      private $DepartamentotableGateway;

     public function __construct(TableGatewayInterface $DepartamentotableGateway)
     {
               
                $this->tableGateway = $DepartamentotableGateway;
     }

     public function fetchAll()
     {
                $sqlSelect = $this->tableGateway->getSql()->select();
                $sqlSelect->columns(array('Cod_Departamento','Nombre_Depto','Sucursal','Fecha_Ingreso','Fecha_Actualizacion'));
                $sqlSelect->join('Sucursales', 'sucursales.Cod_sucursal = departamentos.Sucursal', array('Nombre_Sucursal'), 'left');

                 $resultSet = $this->tableGateway->selectWith($sqlSelect);
                 return $resultSet;
               //return $this->tableGateway->select();
     }


    public function getDepto($Cod_Departamento)
     {
                $Cod_Departamento = $Cod_Departamento;
                $rowset = $this->tableGateway->select(['Cod_Departamento' => $Cod_Departamento]);
                $row = $rowset->current();
                if (! $row) {
                    return false;
                }
                return $row;
     }
    
    public function saveDepto(Departamento $departamento)
     {
            $data = [
                'Cod_Departamento' => $departamento->Cod_Departamento,
                'Nombre_Depto'  => $departamento->Nombre_Depto,
                'Sucursal'  => $departamento->Sucursal,
            ];
           
            $Cod_Departamento = $departamento->Cod_Departamento;

            
           if ($Cod_Departamento != null) {
               $this->tableGateway->insert($data);
               return;
        
            }

     }
     public function updateDepto(Departamento $departamento)
    {          $data = [

                'Cod_Departamento' => $departamento->Cod_Departamento,
                'Nombre_Depto'  => $departamento->Nombre_Depto,
                'Sucursal'  => $departamento->Sucursal,
                 ];

               $Cod_Departamento = $departamento->Cod_Departamento;


                try {
                    
                    $this->getDepto($Cod_Departamento);
                } catch (RuntimeException $e) {
                    /*throw new RuntimeException(sprintf(
                        'No se puede actualizar departamento con identificador',
                        ));*/
                        return false;
                }

                $this->tableGateway->update($data, ['Cod_Departamento' => $Cod_Departamento]);
                return;
    }

    
    public function deleteDepto($Cod_Departamento)
    {
             $this->tableGateway->delete(['Cod_Departamento'=>$Cod_Departamento]);
    }

}