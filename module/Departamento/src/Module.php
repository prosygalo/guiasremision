<?php
namespace Departamento;

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
                Model\DepartamentoTable::class => function($container) {
                    $DepartamentotableGateway = $container->get(Model\TableGateway::class);
                    return new Model\DepartamentoTable($DepartamentotableGateway);
                },
                Model\TableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Departamento());
                    return new TableGateway('departamentos', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\DepartamentoController::class => function($container) {
                    return new Controller\departamentoController (
                        $container->get(Model\DepartamentoTable::class)
                    );
                },
            ],
        ];
    }
}