<?php

namespace Boletasremision\Controller;

use Boletasremision\Form\BoletasremisionForm;
use Boletasremision\Model\Boletasremision;
use Boletasremision\Model\BoletasremisionTable;
use Boletasremision\Model\DetalleTable;
use Zend\Mvc\Controller\AbstractActionController;
use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Sucursal\Model\SucursalTable;
use Conductor\Model\ConductorTable;
use Unidadtransporte\Model\UnidadtransporteTable;
use Producto\Model\ProductoTable;
use Autorizacionsar\Model\Autorizacionsar;
use Autorizacionsar\Model\AutorizacionsarTable;
use Dompdf\Dompdf;
/**
 * This controller is responsible for 
 */

class BoletasremisionController extends AbstractActionController
{
    // Add this property:
    private $container;
    private $BoletasremisionTable;
    private $DetalleTable; 
    private $SucursalTable; 
    private $ConductorTable; 
    private $UnidadtransporteTable; 
    private $ProductoTable; 
    private $AutorizacionsarTable; 
    // Add this constructor:
    public function __construct(ContainerInterface $container, BoletasremisionTable  $BoletasremisionTable, DetalleTable $DetalleTable, SucursalTable $SucursalTable, ConductorTable $ConductorTable, UnidadtransporteTable $UnidadtransporteTable, ProductoTable $ProductoTable, AutorizacionsarTable $AutorizacionsarTable)
    {
            $this->container = $container;
            $this->BoletasremisionTable = $BoletasremisionTable;
            $this->DetalleTable = $DetalleTable;
            $this->SucursalTable = $SucursalTable;
            $this->ConductorTable = $ConductorTable;
            $this->UnidadtransporteTable = $UnidadtransporteTable;
            $this->ProductoTable = $ProductoTable;
            $this->AutorizacionsarTable = $AutorizacionsarTable;
              
    }

    public function indexAction()
    {
         return new ViewModel([
                'Boletas' => $this->BoletasremisionTable->fetchAll(),
            ]);
    }
    public function addAction()
    {
        $fecha= date('Y-m-d');
        //-------Consecutivo autorizacion sar----
        $UltimaAutorizacion = $this->AutorizacionsarTable->getUltimaAutorizacion();
            foreach ($UltimaAutorizacion  as $a):
                $Cod_Autorizacion = $a->Cod_Autorizacion;
                $Consecutivo_Inicial_Establ = $a->Consecutivo_Inicial_Establ;
                $Consecutivo_Inicial_Punto = $a->Consecutivo_Inicial_Punto;
                $Consecutivo_Inicial_Tipo = $a->Consecutivo_Inicial_Tipo;
                $Consecutivo_Inicial_Correlativo = $a->Consecutivo_Inicial_Correlativo;
                $Consecutivo_Final_Correlativo = $a->Consecutivo_Final_Correlativo;
                $Consecutivo_Actual_Establ = $a->Consecutivo_Actual_Establ;
                $Consecutivo_Actual_Punto = $a->Consecutivo_Actual_Punto;
                $Consecutivo_Actual_Tipo = $a->Consecutivo_Actual_Tipo;
                $Consecutivo_Actual_Correlativo = $a->Consecutivo_Actual_Correlativo;
                $Fecha_Limite = $a->Fecha_Limite;
              endforeach;           
                    if($Cod_Autorizacion == NULL){
                            return $this->redirect()->toRoute('boletasremision/errorautorizacion');                           
                    }elseif($fecha > $Fecha_Limite){
                            return $this->redirect()->toRoute('boletasremision/vencimientofecha');
                    }elseif($Cod_Autorizacion != NULL && $Consecutivo_Actual_Correlativo >= $Consecutivo_Final_Correlativo){
                            return $this->redirect()->toRoute('boletasremision/expirocorrelativo');                            
                    }elseif($Cod_Autorizacion != NULL && $Consecutivo_Actual_Correlativo == NULL){                           
                            $form = new BoletasremisionForm();
                            $form->get('submit')->setValue('Guardar');
                            $form->get('Fecha_Emision')->setValue($fecha);
                            $form->get('Consecutivo_Actual_Establ')->setValue($Consecutivo_Inicial_Establ);
                            $form->get('Consecutivo_Actual_Punto')->setValue($Consecutivo_Inicial_Punto); 
                            $form->get('Consecutivo_Actual_Tipo')->setValue($Consecutivo_Inicial_Tipo); 
                            $form->get('Consecutivo_Actual_Correlativo')->setValue($Consecutivo_Inicial_Correlativo);
                            $form->get('Autorizacion_Sar')->setValue($Cod_Autorizacion);                                   
                   }elseif($Cod_Autorizacion != NULL && $Consecutivo_Actual_Correlativo <= $Consecutivo_Final_Correlativo && $Fecha_Limite > $fecha) {
                            $form = new BoletasremisionForm();
                            $form->get('submit')->setValue('Guardar');
                            $form->get('Fecha_Emision')->setValue($fecha);
                            $form->get('Autorizacion_Sar')->setValue($Cod_Autorizacion);
                            $form->get('Consecutivo_Actual_Establ')->setValue($Consecutivo_Actual_Establ);
                            $form->get('Consecutivo_Actual_Punto')->setValue($Consecutivo_Actual_Punto); 
                            $form->get('Consecutivo_Actual_Tipo')->setValue($Consecutivo_Actual_Tipo);
                            $nuevocorrelativo = $Consecutivo_Actual_Correlativo+1;                
                            if(($Consecutivo_Actual_Correlativo >= 1) && ($Consecutivo_Actual_Correlativo < 9)){
                              $a='0000000'.$nuevocorrelativo;
                              $form->get('Consecutivo_Actual_Correlativo')->setValue($a);
                            }elseif(($Consecutivo_Actual_Correlativo >= 9) && ($Consecutivo_Actual_Correlativo < 99)){
                               $b='000000'.$nuevocorrelativo;
                               $form->get('Consecutivo_Actual_Correlativo')->setValue($b);
                            }elseif(($Consecutivo_Actual_Correlativo >= 99) && ($Consecutivo_Actual_Correlativo < 999)){
                               $c='00000'.$nuevocorrelativo;
                               $form->get('Consecutivo_Actual_Correlativo')->setValue($c);
                            }elseif(($Consecutivo_Actual_Correlativo >= 999) && ($Consecutivo_Actual_Correlativo < 9999 )){
                              $d='0000'.$nuevocorrelativo;
                              $form->get('Consecutivo_Actual_Correlativo')->setValue($d);
                            }elseif(($Consecutivo_Actual_Correlativo >= 9999) && ($Consecutivo_Actual_Correlativo < 99999)){
                               $e='000'.$nuevocorrelativo;
                               $form->get('Consecutivo_Actual_Correlativo')->setValue($e);
                            }elseif(($Consecutivo_Actual_Correlativo >= 99999) && ($Consecutivo_Actual_Correlativo < 999999 )){
                               $f='00'.$nuevocorrelativo;
                               $form->get('Consecutivo_Actual_Correlativo')->setValue($f);
                            }elseif(($Consecutivo_Actual_Correlativo >= 999999) && ($Consecutivo_Actual_Correlativo < 9999999)){ 
                               $g='0'.$nuevocorrelativo;
                               $form->get('Consecutivo_Actual_Correlativo')->setValue($g);
                            }else{
                               $form->get('Consecutivo_Actual_Correlativo')->setValue($nuevocorrelativo);
                            }                            
                  }else{
                            return $this->redirect()->toRoute('boletasremision');
                  } 

            //------llenado de los Listado de selección---------------
            $rowset = $this->SucursalTable->getSucursalSelect(); //llenar select sucursal 
            $form->get('Sucursal')->setValueOptions($rowset); 

            $rowset2 = $this->UnidadtransporteTable->getUnidadSelect(); //llenar select unidad 
            $form->get('Unidad_Transporte')->setValueOptions($rowset2); 

            $rowset3 = $this->ConductorTable->getConductorSelect(); //llenar select Conductor 
            $Conductor = $form->get('Conductor')->setValueOptions($rowset3); 

            $rowset4 = $this->ProductoTable->getProductoSelect(); //llenar select Conductor 
            $productos = $form->get('productos')->setValueOptions($rowset4); 

            //-------Solicitud-------------------------
            $request = $this->getRequest();
            if (! $request->isPost()) {
                 return ['form' => $form];

            }          
            $boletasremision = new Boletasremision();
            $form->setInputFilter($boletasremision->getInputFilter());//Filtrado y vlidacion  de los  datos
            $form->setData($request->getPost());
                
            if (! $form->isValid()){
                return ['form' => $form];
            }
            //--------Tomar datos del formulario-y los guardamos en la base de datos, para ello realizamos tres procesos.
            $boletasremision->exchangeArray($form->getData());     
            $Cod_Producto = $this->request->getPost("Cod_Producto"); //confirmar existe un producto en el detalle
            $Cantidad =     $this->request->getPost("Cantidad");
                
           if($Cod_Producto != NULL && $Cantidad != NULL){
                // Almacenar los datos en la tabla boleta de remision  
                   $lasId = $this->BoletasremisionTable->insertBoleta($boletasremision);
                //Actualice el numero de consecutivo de la boleta de la guia de remision en la tabla autorizaciones SAR 
                   $Cod_Autorizacion= $this->request->getPost("Autorizacion_Sar");
                   $Consecutivo_Actual_Establ= $this->request->getPost("Consecutivo_Actual_Establ");
                   $Consecutivo_Actual_Punto= $this->request->getPost("Consecutivo_Actual_Punto");
                   $Consecutivo_Actual_Tipo= $this->request->getPost("Consecutivo_Actual_Tipo");
                   $Consecutivo_Actual_Correlativo = $this->request->getPost("Consecutivo_Actual_Correlativo");
                   
                   $this->AutorizacionsarTable->UpdateConsecutivoActual($Cod_Autorizacion, $Consecutivo_Actual_Establ, $Consecutivo_Actual_Punto, $Consecutivo_Actual_Tipo, $Consecutivo_Actual_Correlativo);                   
                //Cada producto debe de registrarse con el codigo de boleta  y almacenarse en el detalle
                    $this->DetalleTable->insertDetalle($Cod_Producto, $lasId, $Cantidad);// Enviar Datos a la tabla detalle a la BD                        
                    return $this->redirect()->toRoute('boletasremision');               
            }
            return $this->redirect()->toRoute('boletasremision/add');

    }

    public function  detalleAction()
    {
        //Recibir el código de boleta  para mostrar el detalle que corresponde
        $Cod_Boleta = $this->params()->fromRoute('Cod_Boleta');
        //Si el código es incorrecto redirigie a listado de boletas
        if (!$Cod_Boleta) {
            return $this->redirect()->toRoute('boletasremision');
        }
        //consultar registro del código de boleta recibido
        try {
            $boleta = $this->BoletasremisionTable->getBoleta($Cod_Boleta);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('boletasremision');
        }
        //crear instancia de formulario
        $form = new BoletasremisionForm();
        $form->bind($boleta);
        //------llenado de los Listado de selección---------------
        $rowset = $this->SucursalTable->getSucursalSelect(); //llenar select sucursal 
        $form->get('Sucursal')->setValueOptions($rowset); 

        $rowset2 = $this->UnidadtransporteTable->getUnidadSelect(); //llenar select unidad 
        $form->get('Unidad_Transporte')->setValueOptions($rowset2); 

        $rowset3 = $this->ConductorTable->getConductorSelect(); //llenar select Conductor 
        $Conductor = $form->get('Conductor')->setValueOptions($rowset3); 

        $rowset4 = $this->ProductoTable->getProductoSelect(); //llenar select Conductor 
        $productos = $form->get('productos')->setValueOptions($rowset4); 
        //Verifica si la usuario ha enviado el formulario
        $request = $this->getRequest();
        $viewData = [
            'Cod_Boleta' => $Cod_Boleta, 'form' => $form,//Bindear formulario y registro de boleta
            'detalle'=>$this->DetalleTable->detalle($Cod_Boleta),//Enviar una variable a la tabla donde se mostrará el producto y la cantidad correspondiente al cada codigo de boleta  
        ];
        //Verifica si la usuario ha enviado el formulario, de lo contrario retorna el viewdata
        if (! $request->isPost()) {
            return $viewData;
        } 
                     
    }

    // formato Json para pruebas
    public function productopruebaAction()
    { 
       //if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
       //{  
        $Sucursalselect = $this->DetalleTable->saveDetalle();
        return  new JsonModel($sucursalselect);
       //} else {
        // return a 404 if this action is not called via ajax
       //$this->getResponse()->setStatusCode(404);
        //return NULL;
   }

    public function reporteAction()
    {
      //Recibir el código de boleta  para mostrar el detalle que corresponde
        $Cod_Boleta = $this->params()->fromRoute('Cod_Boleta');
        //Si el código es incorrecto redirigie a listado de boletas
        if (!$Cod_Boleta) {
            return $this->redirect()->toRoute('boletasremision');
        }
        //consultar registro del código de boleta recibido
        try {
            $boleta = $this->BoletasremisionTable->getBoleta($Cod_Boleta);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('boletasremision');
        }
        //crear instancia de formulario
        $form = new BoletasremisionForm();
        $form->bind($boleta);
        //------llenado de los Listado de selección---------------
        $rowset = $this->SucursalTable->getSucursalSelect(); //llenar select sucursal 
        $form->get('Sucursal')->setValueOptions($rowset); 

        $rowset2 = $this->UnidadtransporteTable->getUnidadSelect(); //llenar select unidad 
        $form->get('Unidad_Transporte')->setValueOptions($rowset2); 

        $rowset3 = $this->ConductorTable->getConductorSelect(); //llenar select Conductor 
        $Conductor = $form->get('Conductor')->setValueOptions($rowset3); 

        $rowset4 = $this->ProductoTable->getProductoSelect(); //llenar select Conductor 
        $productos = $form->get('productos')->setValueOptions($rowset4); 
        //Verifica si la usuario ha enviado el formulario
        $request = $this->getRequest();

        $viewData = [
            'Cod_Boleta' => $Cod_Boleta, 'form' => $form,//Bindear formulario y registro de boleta
            'detalle'=>$this->DetalleTable->detalle($Cod_Boleta),//Enviar una variable a la tabla donde se mostrará el producto y la cantidad correspondiente al cada codigo de boleta 
        ];
        //Verifica si la usuario ha enviado el formulario, de lo contrario retorna el viewdata
        if (! $request->isPost()) {
            return $viewData;
        } 

       $r = $this->getResponse();

       $r->setContent(file_get_contents('guiasremision/reporte')); //

       return $r;         
    }
    public function pdfAction()
    {
        //Recibir el código de boleta  para mostrar el detalle que corresponde
        $Cod_Boleta = $this->params()->fromRoute('Cod_Boleta');
        //Si el código es incorrecto redirigie a listado de boletas
        if (!$Cod_Boleta) {
            return $this->redirect()->toRoute('boletasremision');
        } 

        $html = file_get_contents("http://guiasremision/boletasremision/reporte/$Cod_Boleta");
        //instantiate and use the dompdf class
        $dompdf = new Dompdf();
        /*$dompdf->set_base_path("http://guiasremision/css/bootstrap.min.css");
        $dompdf->set_base_path("http://guiasremision/js/jquery.min.js");
        $dompdf->set_base_path("http://guiasremision/js/bootstrap.min.js");*/
        //$content .= '<link type="text/css" media="all" href="https://guiasremision/css/bootstrap.min.css" rel="stylesheet" />';
        //Cargar el archivo HTMl
        $dompdf->loadHTML($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
       // Output the generated PDF to Browser
        return $dompdf->stream('boletaremision.pdf');
    }
      public function  errorautorizacionAction()
    {   //redirecciona a la vista de error
         return new ViewModel([
                'Message' => 'No puede emitir boletas para guía  de remisión sin autorización previa, favor autorice sus documentos fiscales',
            ]);
     
    }
    public function  expirocorrelativoAction()
    {
        //redirecciona a la vista  de error
        return new ViewModel([
                'Message' => 'Lo sentimos, el número de correlativo autorizado ha llegado ha su límite, favor autorice impresión de documento fiscal',
            ]);
    }
    public function  vencimientofechaAction()
    {   //redirecciona a la vista de error
         return new ViewModel([
                'Message' => 'La fecha límite de emisión de documento fiscal ha expirado',
            ]);
    }


}

