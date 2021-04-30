<?php
namespace Usuario;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Usuario\Model\UsuarioTable;


class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


  public function getServiceConfig()
   {
        return [
           'factories' => [
                Model\UsuarioTable::class => function($container) {
                    $UsuarioTableGateway = $container->get(Model\UsuarioTableGateway::class);
                    return new Model\UsuarioTable($UsuarioTableGateway);
                },
                Model\UsuarioTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Entidad());
                    return new TableGateway('usuarios', $dbAdapter, null, $resultSetPrototype);
                }
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
               Controller\UsuarioController::class => function($container) {
                    return new Controller\UsuarioController (
                        $container->get(Model\UsuarioTable::class)
                    );
                },
                Controller\AuthController::class => function($container) {
                    return new Controller\AuthController (
                        $container->get(Model\UsuarioTable::class)
                    );
                },
            ],
        ];
    }
}