<?php

namespace Autorizacionsar\Controller;

use Autorizacionsar\Form\AutorizacionsarForm;
use Autorizacionsar\Model\Autorizacionsar;
use Autorizacionsar\Model\AutorizacionsarTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class AutorizacionsarController extends AbstractActionController
{
 // Add this property:
     private $table;

    // Add this constructor:
     public function __construct(AutorizacionsarTable $table)
     {
            $this->table = $table;
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
            $this->table->saveAuto($autorizacionsar);
            //view helper
            return $this->redirect()->toRoute('autorizacionsar');
            
    }
   
}