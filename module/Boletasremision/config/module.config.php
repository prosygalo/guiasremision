<?php
namespace Boletasremision;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
'router' => [
    'routes' => [
        'boletasremision' => [
            // First we define the basic options for the parent route:
            'type' => Literal::class,
            'options' => [
                'route'    => '/boletasremision',
                'defaults' => [
                    'controller' => Controller\BoletasremisionController::class,
                    'action'     => 'index',
                ],
            ],

            'may_terminate' => true,
             // Child routes begin:
            'child_routes' => [
             'add' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/add',
                        'defaults' => [
                            'action' => 'add',
                        ],
                    ],
                ],

                'errorautorizacion' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/errorautorizacion',
                        'defaults' => [
                            'action' => 'errorautorizacion',
                        ],
                    ],
                ],
                 'vencimientofecha' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/vencimientofecha',
                        'defaults' => [
                            'action' => 'vencimientofecha',
                        ],
                    ],
                ],
                 'expirocorrelativo' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/expirocorrelativo',
                        'defaults' => [
                            'action' => 'expirocorrelativo',
                        ],
                    ],
                ],

                'detalle' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/detalle[/:Cod_Boleta]',
                        'defaults' => [
                            'action' => 'detalle',
                        ],   
                    ],
                ],

                'reporte' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/reporte[/:Cod_Boleta]',
                        'defaults' => [
                            'action' => 'reporte',
                        ],   
                    ],
                ],
                 'pdf' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/pdf[/:Cod_Boleta]',
                        'defaults' => [
                            'action' => 'pdf',
                        ],   
                    ],
                ],
                //atencion linea de pruebas de codigo
                'productoprueba' => [
                    'type' =>Segment::class,
                    'options' => [
                        'route'    => '/productoprueba',
                        'defaults' => [
                            'action' => 'productoprueba',
                        ],   
                    ],
                ],
                 
            ],

        ],
    ],
],
 
    'view_manager' => [
     'template_path_stack' => [
            'boletasremision' => __DIR__ . '/../view',
       ],
    
    'strategies' => [
            'ViewJsonStrategy',
           ],
      ],  
];
