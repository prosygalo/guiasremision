<?php

namespace Departamento\Controller;

use Departamento\Form\DepartamentoForm;
use Departamento\Model\Departamento;
use Departamento\Model\DepartamentoTable;
use Sucursal\Model\Sucursal;
use Sucursal\Model\SucursalTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger::NAMESPACE_ERROR;


class DepartamentoController extends AbstractActionController
{
 // Add this property:
    private $table;

    //private $table2;
    // Add this constructor:

    public function __construct(DepartamentoTable  $table)//, SucursalTable $Table2 )
     {
            $this->table = $table;
           // $this->table2 = $table2;
     }

    public function indexAction()
     {
            return new ViewModel([
                'depto' => $this->table->fetchAll(),
            ]);
     }

      public function addAction()
    {
        $form = new DepartamentoForm();
        $form->get('submit')->setValue('Guardar');
        
        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $departamento = new Departamento();
        $form->setInputFilter($departamento->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

         $departamento->exchangeArray($form->getData());
         $Cod_Departamento= [
                'Cod_Departamento' => $departamento->Cod_Departamento,
            ];
               
         $existe = $this->table->getDepto($Cod_Departamento);
           
         if ($existe) {

            return ['form' => $form];
            //$FlashMessenger = $this->FlashMessenger()->addSuccessMessage("El código ya existe"); 

             
        }             
              
              $this->table->saveDepto($departamento);
             return $this->redirect()->toRoute('departamento'); 
                     
    }
   
    public function editAction()
    {
        $Cod_Departamento = $this->params()->fromRoute('Cod_Departamento');

        if (!$Cod_Departamento) {
            return $this->redirect()->toRoute('departamento/add');
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $departamento = $this->table->getDepto($Cod_Departamento);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('departamento');
        }

        $form = new DepartamentoForm();
        $form->bind($departamento);
        $form->get('submit')->setAttribute('value', 'Actualizar');

        $request = $this->getRequest();
        $viewData = ['Cod_Departamento' => $Cod_Departamento, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($departamento->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->UpdateDepto($departamento);

        // Redirect to album list
        return $this->redirect()->toRoute('departamento');
    }
        

    public function deleteAction()
    {
            $Cod_Departamento = $this->params()->fromRoute('Cod_Departamento');
            
            if (!$Cod_Departamento) {
                return $this->redirect()->toRoute('departamento');
            }

            $request = $this->getRequest();
            if ($request->isPost()) {
                $del = $request->getPost('del', 'No');

                if ($del == 'Yes') {
                    $Cod_Departamento=$request->getPost('Cod_Departamento');
                    $this->table->deleteDepto($Cod_Departamento);
                }

                // Redirect to list 
                return $this->redirect()->toRoute('departamento');
            }
             return [
            'Cod_Departamento'    => $Cod_Departamento,
            'dep' => $this->table->getDepto($Cod_Departamento),
        ];
            
        }
}