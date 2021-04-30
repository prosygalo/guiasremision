<?php
namespace Usuario\Service\Factory;
 
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Interop\Container\ContainerInterface;
use Usuario\Storage\AuthStorage;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;

class AuthenticationServiceFactory implements FactoryInterface
{
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $dbAdapter = $container->get(AdapterInterface::class);

        $dbTableAuthAdapter = new CredentialTreatmentAdapter(
           $dbAdapter,
           'usuarios', 
           'Correo', 
           'Clave'
          );

        $select = $dbTableAuthAdapter->getDbSelect();
        //$select->where('Estado = "Activo"');
         
        $authService = new AuthenticationService($container->get(AuthStorage::class), $dbTableAuthAdapter);
        return $authService;
  }
    
}