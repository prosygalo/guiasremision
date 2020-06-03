<?php
 
 namespace Autorizacionsar;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;


return [    
'router' => [
    'routes' => [
        'autorizacionsar' => [
            // First we define the basic options for the parent route:
            'type' => Literal::class,
            'options' => [
                'route'    => '/autorizacionsar',
                'defaults' => [
                    'controller' => Controller\AutorizacionsarController::class,
                    'action'     => 'index',
                ],
            ],

            // The following allows "/news" to match on its own if no child
            // routes match:
            'may_terminate' => true,
             // Child routes begin:
            'child_routes' => [
                
                'edit' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/edit[/:Cod_Autorizacion]',
                        'defaults' => [
                            'action' => 'edit',
                        ],   
                    ],
                ],

                
                 'delete' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/delete[/:Cod_Autorizacion]',
                        'defaults' => [
                            'action' => 'delete',
                        ],
                    ],
                ],
                'add' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/add',
                        'defaults' => [
                            'action' => 'add',
                        ],
                    ],
                ],
                 
            ],

        ],
    ],
],
   
    'view_manager' => [
        'template_path_stack' => [
            'autorizacionsar' => __DIR__ . '/../view',
        ],
    ],
];