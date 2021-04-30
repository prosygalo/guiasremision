<?php

namespace Autorizacionsar\Controller;

use Autorizacionsar\Form\AutorizacionsarForm;
use Autorizacionsar\Model\Autorizacionsar;
use Autorizacionsar\Model\AutorizacionsarTable;
use Sucursal\Model\SucursalTable;
use Zend\Mvc\Controller\AbstractActionController;
use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;

/**
 * This controller is responsible for 
 */

class AutorizacionsarController extends AbstractActionController
{
 // Add this property:
     private $container;
    //private $DepartamentoTable;
    private $table;
    private $SucursalTable; 

    // Add this constructor:
     public function __construct(ContainerInterface $container,AutorizacionsarTable $table, SucursalTable $SucursalTable)
     {
            $this->container = $container;
            $this->table = $table;
            $this->SucursalTable = $SucursalTable;
     }
    public function indexAction()
     {
            return new ViewModel([
                'auto' => $this->table->fetchAll(),
            ]);
     }
    public function addAction()
    {
            $form = new AutorizacionsarForm();
            $form->get('submit')->setValue('Guardar');
            $rowset = $this->SucursalTable->getSucursalSelect(); //llenar select sucursal 
            $form->get('Sucursal')->setValueOptions($rowset); 
        
            $request = $this->getRequest();

            if (! $request->isPost()) {
                return ['form' => $form];
            }

            $autorizacionsar = new Autorizacionsar();
            $form->setInputFilter($autorizacionsar->getInputFilter());
            $form->setData($request->getPost());

            if (! $form->isValid()) {
                return ['form' => $form];
            }

            $autorizacionsar->exchangeArray($form->getData());
            $this->table->insertAuto($autorizacionsar);
            //view helper
            return $this->redirect()->toRoute('autorizacionsar');
            
    }
   
}