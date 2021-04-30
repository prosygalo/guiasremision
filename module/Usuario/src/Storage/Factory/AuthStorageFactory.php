<?php
namespace Usuario\Storage\Factory;
 
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Usuario\Storage\AuthStorage;
 

class AuthStorageFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $storage = new AuthStorage('guiasremision3.0');
        
        $storage->setServiceLocator($container);
        
        $storage->setDbHandler();
         
        return $storage;
    }
}