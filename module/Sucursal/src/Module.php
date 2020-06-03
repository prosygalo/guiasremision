<?php
namespace Sucursal;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

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
                Model\SucursalTable::class => function($container) {
                    $SucursaltableGateway = $container->get(Model\TableGateway::class);
                    return new Model\SucursalTable($SucursaltableGateway);
                },
                Model\TableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Sucursal());
                    return new TableGateway('sucursales', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\SucursalController::class => function($container) {
                    return new Controller\SucursalController (
                        $container->get(Model\SucursalTable::class)
                    );
                },
            ],
        ];
    }
}