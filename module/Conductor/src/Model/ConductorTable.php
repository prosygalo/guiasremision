<?php

namespace Conductor\Model;

use RuntimeException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGatewayInterface;


class ConductorTable
{
      private $ConductortableGateway;

     public function __construct(TableGatewayInterface $ConductortableGateway)
     {
               
                $this->tableGateway = $ConductortableGateway;
     }

     public function fetchAll()
     {

        return $this->tableGateway->select();
              
     }

    public function getConductor($Cod_Conductor)
     {
                $Cod_Conductor = $Cod_Conductor;
                $rowset = $this->tableGateway->select(['Cod_Conductor' => $Cod_Conductor]);
                $row = $rowset->current();
                if (! $row) {
                    return false;
                }
                return $row;
     }
     public function getConductorSelect(){

                $rowset = $this->tableGateway->getSql()->select();
                $rowset->columns(array('Cod_Conductor','Nombres_Conductor'));
                $rowset->order('Nombres_Conductor Asc');
                $resultSet = $this->tableGateway->selectWith($rowset); 

                $data= array();
                foreach($resultSet as $row){
                   $data[$row->Cod_Conductor] = $row->Nombres_Conductor;
                }
                   return $data;            
     }
    public function insertConductor(Conductor $conductor)
     {
            $data = [
                'Cod_Conductor' => $conductor->Cod_Conductor,
                'Nombres_Conductor'  => $conductor->Nombres_Conductor,
                'Apellidos_Conductor' =>$conductor->Apellidos_Conductor,
                'Rtn'  => $conductor->Rtn,

            ];
           
            $Cod_Conductor = $conductor->Cod_Conductor;

            
           if ($Cod_Conductor != null) {
               $this->tableGateway->insert($data);
               return;
        
            }

     }
     public function updateConductor(Conductor $conductor)
    {          

            $data = [
                'Cod_Conductor' => $conductor->Cod_Conductor,
                'Nombres_Conductor'  => $conductor->Nombres_Conductor,
                'Apellidos_conductor' =>$conductor->Apellidos_Conductor,
                'Rtn'  => $conductor->Rtn,

            ];

               $Cod_Conductor = $conductor->Cod_Conductor;


                try {
                    
                    $this->getConductor($Cod_Conductor);
                } catch (RuntimeException $e) {
                    /*throw new RuntimeException(sprintf(
                        'No se puede actualizar departamento con identificador',
                        ));*/
                        return false;
                }

                $this->tableGateway->update($data, ['Cod_Conductor' => $Cod_Conductor]);
                return ;
    }

    
    public function deleteConductor($Cod_Conductor)
    {
             $this->tableGateway->delete(['Cod_Conductor'=>$Cod_Conductor]);
    }

}