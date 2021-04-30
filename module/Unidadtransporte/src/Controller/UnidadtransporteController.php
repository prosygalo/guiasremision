<?php

namespace Unidadtransporte\Controller;

use Unidadtransporte\Form\UnidadtransporteForm;
use Unidadtransporte\Model\Unidadtransporte;
use Unidadtransporte\Model\UnidadtransporteTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * This controller is responsible for 
 */

class UnidadtransporteController extends AbstractActionController
{
 // Add this property:
    private $table;

    // Add this constructor:
    public function __construct(UnidadtransporteTable $table)
     {
            $this->table = $table;
     }

    public function indexAction()
     {
            return new ViewModel([
                'unit' => $this->table->fetchAll(),
            ]);
     }


      public function addAction()
    {
        $form = new UnidadtransporteForm();
        $form->get('submit')->setValue('Guardar');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $unidadtransporte = new Unidadtransporte();
        $form->setInputFilter($unidadtransporte->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $unidadtransporte->exchangeArray($form->getData());
        $this->table->saveUnidad($unidadtransporte);
        return $this->redirect()->toRoute('unidadtransporte');
    }
   
    public function editAction()
    {
        $Cod_Unidad = $this->params()->fromRoute('Cod_Unidad');

        if (!$Cod_Unidad) {
            return $this->redirect()->toRoute('departamento/add');
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $unidadtransporte = $this->table->getUnidad($Cod_Unidad);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('unidadtransporte');
        }

        $form = new UnidadtransporteForm();
        $form->bind($unidadtransporte);
        $form->get('submit')->setAttribute('value', 'Actualizar');

        $request = $this->getRequest();
        $viewData = ['Cod_Unidad' => $Cod_Unidad, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($unidadtransporte->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->UpdateUnidad($unidadtransporte);

        // Redirect to album list
        return $this->redirect()->toRoute('unidadtransporte');
    }
        

    public function deleteAction()
    {
            $Cod_Unidad = $this->params()->fromRoute('Cod_Unidad');
            
            if (!$Cod_Unidad) {
                return $this->redirect()->toRoute('unidadtransporte');
            }

            $request = $this->getRequest();
            if ($request->isPost()) {
                $del = $request->getPost('del', 'Cancelar');

                if ($del == 'Borrar') {
                    $Cod_Unidad=$request->getPost('Cod_Unidad');
                    $this->table->deleteUnidad($Cod_Unidad);
                }

                // Redirect to list 
                return $this->redirect()->toRoute('unidadtransporte');
            }
             return [
            'Cod_Unidad'    => $Cod_Unidad,
            'unit' => $this->table->getUnidad($Cod_Unidad),
        ];
            
        }
}