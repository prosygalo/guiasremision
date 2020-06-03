<?php
namespace Usuario;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;


return [

'router' => [
    'routes' => [
        'usuario' => [
            // First we define the basic options for the parent route:
            'type' => Literal::class,
            'options' => [
                'route'    => '/usuario',
                'defaults' => [
                    'controller' => Controller\RegistroController::class,
                    'action'     => 'index',
                ],
            ],

            // The following allows "/news" to match on its own if no child
            // routes match:
            'may_terminate' => true,
             // Child routes begin:
            'child_routes' => [

                'registro' => [
                    'type' =>Segment::class,
                    'options' => [
                       'route'    => '/registro',
                        'defaults' => [
                            'action' => 'registro',
                        ],
                    ],
                ],
                 
                ],
            ],
                
            'login' => [
            // First we define the basic options for the parent route:
            'type' => Literal::class,
            'options' => [
                'route'    => '/login',
                'defaults' => [
                    'controller' => Controller\AuthController::class,
                    'action'     => 'login',
                    ],
                ],

             ],

            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],

            'perfil' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/perfil[/:action]',
                    'defaults' => [
                        'controller' => Controller\PerfilController::class,
                        'action'     => 'perfil',
                    ],
                ],
            ],

              'cambiarclave' => [
                    'type' => Literal::class,
                    'options' => [
                        'route'    => '/cambiarclave',
                        'defaults' => [
                            'controller' => Controller\RestablecerClaveController::class,
                            'action'     => 'cambiarclave',
                        ],
                        'constraints' => [
                            'id' => '[1-9]+',
                        ],
                    ],
                ],
                    'restablecerclave' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/restablecerclave',
                            'defaults' => [
                                'controller' => Controller\RestablecerClaveController::class,
                                'action'     => 'restablecerclave',
                            ],

                         ],
                     ],
         
         ],

     ],

    'view_manager' => [
        'template_path_stack' => [
            'usuario' => __DIR__ . '/../view',
        ],
    ],
];