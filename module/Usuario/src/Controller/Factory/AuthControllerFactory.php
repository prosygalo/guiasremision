<?php
namespace Usuario\Controller\Factory;

use Interop\Container\ContainerInterface;
use Usuario\Controller\AuthController;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Authentication\AuthenticationService;
use Usuario\Model\UsuarioTable;


// Factory class
class AuthControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        
        $authService = $container->get(AuthenticationService::class);
        $UsuarioTable = $container->get(UsuarioTable::class);
        $controller = new AuthController($authService, $UsuarioTable);
         
        return $controller;
    }
}

