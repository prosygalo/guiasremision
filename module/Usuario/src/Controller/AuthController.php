<?php
namespace Usuario\Controller;

use Usuario\Form\LoginForm;
use Usuario\Model\Entidad;
use Usuario\Model\UsuarioTable;
use Usuario\Form\Validation\LoginFormFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Crypt\Password\Bcrypt;
use Zend\I18n\Validator as I18nValidator; 

/**
 * Este controlador es responsable de permitir que el usuario inicie y cierre la sesión..
 */
class AuthController extends AbstractActionController
{
    
    protected $authService;

    /**
     * Inyectaremos authService via factory
     */
   public function __construct(AuthenticationService $authService,UsuarioTable $UsuarioTable)
    {
        $this->authService = $authService;
        $this->UsuarioTable = $UsuarioTable;
    }
    /**
     * Autenticación del usuarios con las credenciales dadas.
     */
     public function loginAction()
    {
        $form = new LoginForm();
        $form->get('submit')->setValue('inicie sesión');
        $request = $this->getRequest();
        //Verifica si la usuario ha enviado el formulario.
        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $Validation = new LoginFormFilter();
        $form->setInputFilter($Validation->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $Correo =  $this->request->getPost("Correo");
        $Clave  =  $this->request->getPost("Clave");
                      
        //Establecemos como datos a autenticar los que nos llegan del formulario
        $this->authService->getAdapter()->setIdentity($Correo);
        $this->authService->getAdapter()->setCredential($Clave);

        //Le decimos al servicio de autenticación que lleve a cabo la identificacion  
        $result = $this->authService->authenticate();
            
        //Si el resultado del login es falso, es decir no son correctas las credenciales
        if (! $result->isValid())
        {
        //$this->flashMessenger()->addErrorMessage('¡Nombre de usuario o clave incorrecta!');     
            return ['form' => $form];
        }
        //Si el resultado del login es verdadero, es decir son correctas las credenciales
        $resultRow = $this->authService->getAdapter()->getResultRowObject();
        $this->authService->getStorage()->write(
                    array(
                        'Cod_Usuario'   => $resultRow->Cod_Usuario,
                        'Rol'           => $resultRow->Rol,
                        'Correo'        => $Correo,
                        'Estado'        => $resultRow->Estado,
                        'ip_address'    => $this->getRequest()->getServer('REMOTE_ADDR'),
                        'user_agent'    => $request->getServer('HTTP_USER_AGENT'),
                         )
                    );
        return $this->redirect()->toRoute('home');
    }
    

    /**
     * La acción "cerrar sesión" realiza la operación de cierre de sesión
     */
   public function logoutAction()
    {
       $this->authService->getStorage()->clear();
       
       return $this->redirect()->toRoute('login');
    }

}
