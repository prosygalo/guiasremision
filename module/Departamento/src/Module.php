<?php
namespace Departamento;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Sucursal\Model\SucursalTable;

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
                Model\DepartamentoTable::class => function($container){
                    $DepartamentoTableGateway = $container->get(Model\DepartamentoTableGateway::class);
                    return new Model\DepartamentoTable($DepartamentoTableGateway);
                },

                Model\DepartamentoTableGateway::class => function ($container) {
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
                    return new Controller\DepartamentoController(
                       $container,
                       $container->get(Model\DepartamentoTable::class),
                       $container->get(SucursalTable::class)
                    );
                },
            ],
        ];
    }


   /* public function getServiceConfig()
    {
        return [


            



            'factories' => [
                Model\EmpleoTable::class => function ($container) {
                    $tableGateway = $container->get(Model\EmpleoTableGateway::class);
                    return new Model\EmpleoTable($tableGateway);
                },
                Model\EmpleoTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Empleo());
                    return new TableGateway('empleo', $dbAdapter, null, $resultSetPrototype);
                },
                Model\UsuarioTable::class => function ($container) {
                    $tableGateway = $container->get(Model\UsuarioTableGateway::class);
                    return new Model\UsuarioTable($tableGateway);
                },
                Model\UsuarioTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Usuario());
                    return new TableGateway('vw_usuario', $dbAdapter, null, $resultSetPrototype);
                },
                
                Model\InteraccionTable::class => function ($container) {
                    $tableGateway = $container->get(Model\InteraccionTableGateway::class);
                    return new Model\InteraccionTable($tableGateway);
                },
                Model\InteraccionTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    return new TableGateway('interaccion', $dbAdapter, null);
                },
                
                Model\UbicacionTable::class => function ($container) {
                    $tableGateway = $container->get(Model\UbicacionTableGateway::class);
                    return new Model\UbicacionTable($tableGateway);
                },
                Model\UbicacionTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Ubicacion());
                    return new TableGateway('ubicacion', $dbAdapter, null, $resultSetPrototype);
                },
                
                Factory\MailFactory::class => function ($container) {
                    $config = $container->get('config');
                    $transport = new Sendmail();
                    if (isset($config['mail']['transport']['options'])) {
                        // $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
                    } else {
                        throw new RuntimeException(sprintf('Could not find row with identifier %d', $codEmpleo));
                    }
                    return $transport;
                }
            ]
        ];
    }*/
}