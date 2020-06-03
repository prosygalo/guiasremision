<?php
namespace Sucursal\Controller;

use Sucursal\Form\SucursalForm;
use Sucursal\Model\Sucursal;
use Sucursal\Model\SucursalTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SucursalController extends AbstractActionController
{
 // Add this property:
    private $table;

    // Add this constructor:
    public function __construct(SucursalTable $table)
     {
            $this->table = $table;
     }

    public function indexAction()
     {
            return new ViewModel([
                'sucur' => $this->table->fetchAll(),
            ]);
     }
     
     public function addAction()
     {
            $form = new SucursalForm();
            $form->get('submit')->setValue('Guardar');

            $request = $this->getRequest();

            if (! $request->isPost()) {
                return ['form' => $form];
            }

            $sucursal = new Sucursal()
            ;
            $form->setInputFilter($sucursal->getInputFilter());
            $form->setData($request->getPost());

            if (! $form->isValid()) {
                return ['form' => $form];
            }

            $sucursal->exchangeArray($form->getData());
            $this->table->saveSucursal($sucursal);
            //view helper
            return $this->redirect()->toRoute('sucursal/add');
            
    }
   
    public function editAction()
    {
        $Cod_Sucursal = $this->params()->fromRoute('Cod_Sucursal',null);

        if (null === $Cod_Sucursal) {
            return $this->redirect()->toRoute('sucursal/add');
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $sucursal = $this->table->getSucursal($Cod_Sucursal);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('sucursal');
        }

        $form = new SucursalForm();
        $form->bind($sucursal);
        $form->get('submit')->setAttribute('value', 'Actualizar');

        $request = $this->getRequest();
        $viewData = ['Cod_Sucursal' => $Cod_Sucursal, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($sucursal->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->UpdateSucursal($sucursal);

        // Redirect to album list
        return $this->redirect()->toRoute('sucursal');
    }

    public function deleteAction()
    {
            $Cod_Sucursal = $this->params()->fromRoute('Cod_Sucursal');
            
            if (!$Cod_Sucursal) {
                return $this->redirect()->toRoute('sucursal');
            }

            $request = $this->getRequest();
            if ($request->isPost()) {
                $del = $request->getPost('del', 'No');

                if ($del == 'Yes') {
                    $Id= (int) $request->getPost('Cod_Sucursal');
                    $this->table->deleteSucursal($Cod_Sucursal);
                }

                // Redirect to list 
                return $this->redirect()->toRoute('sucursal');
            }
             return [
            'Cod_Sucursal'    => $Cod_Sucursal,
            'suc' => $this->table->getSucursal($Cod_Sucursal),
        ];
            
        }
}