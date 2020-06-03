<?php

namespace Sucursal\Model;

use RuntimeException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGatewayInterface;


class SucursalTable
{
    private $SucursaltableGateway;

    public function __construct(TableGatewayInterface $SucursaltableGateway)
     {
               $this->tableGateway = $SucursaltableGateway;
     }

     public function fetchAll()
     {
                
               return $this->tableGateway->select();
     }

    public function getSucursal($Cod_Sucursal)
     {
                $Cod_Sucursal = $Cod_Sucursal;

                $rowset = $this->tableGateway->select(['Cod_Sucursal' => $Cod_Sucursal]);
                $row = $rowset->current();
                if (! $row) {
                    /*throw new RuntimeException(sprintf(
                        'no encuentra el codigo de sucursal ',
                        
                    ));*/
                    return false;
                }
                return $row;
     }

    public function getSucursalSelect(){

                $select = $this->tableGateway->getSql()->select();
                $select->columns(array('Cod_Sucursal','Nombre_Sucursal'));
                $result=$this->tableGateway->selectWith($select);

                foreach ($result as $res) {
                    $data[$res['Cod_Sucursal']] = $res['Nombre_Sucursal'];
                }
                return $data;

     }

    
    public function saveSucursal(Sucursal $sucursal)
     {
             $data = [
                'Cod_Sucursal' => $sucursal->Cod_Sucursal,
                'Nombre_Sucursal'  => $sucursal->Nombre_Sucursal,
                'RTN'  => $sucursal->RTN,
                'Direccion'  => $sucursal->Direccion,
                'Telefono'  => $sucursal->Telefono,
                'Correo'  => $sucursal->Correo,
             ];
           
             $Cod_Sucursal = $sucursal->Cod_Sucursal;
              
           if ($Cod_Sucursal != null) {
               $this->tableGateway->insert($data);
               return;
        
            }
     }
     public function updateSucursal(Sucursal $sucursal)
    {        
            $data = [

                'Cod_Sucursal' => $sucursal->Cod_Sucursal,
                'Nombre_Sucursal'  => $sucursal->Nombre_Sucursal,
                'RTN'  => $sucursal->RTN,
                'Direccion'  => $sucursal->Direccion,
                'Telefono'  => $sucursal->Telefono,
                'Correo'  => $sucursal->Correo,
             ];

                $Cod_Sucursal = $sucursal->Cod_Sucursal;

                try {
                    
                    $this->getSucursal($Cod_Sucursal);
                } catch (RuntimeException $e) {
                    /*throw new RuntimeException(sprintf(
                        'No se puede actualizar sucursal',
                         
                    ));*/
                    return false;
                }

                $this->tableGateway->update($data, ['Cod_Sucursal' => $Cod_Sucursal]);
                return;
    }

    
    public function deleteSucursal($Cod_Sucursal)
    {
             $this->tableGateway->delete(['Cod_Sucursal'=>$Cod_Sucursal]);
    }

}