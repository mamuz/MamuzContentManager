<?php

return array(
    'router'                 => array(
        'routes' => array(
            'content' => array(
                'type'          => 'segment',
                'options'       => array(
                    'route'       => '[/:path][/]',
                    'constraints' => array(
                        'path' => '[a-zA-Z][/a-zA-Z0-9_-]*',
                    ),
                    'defaults'    => array(
                        'controller' => 'MamuzContentManager\Controller\Query',
                        'action'     => 'page',
                    ),
                ),
                'priority'      => -1000,
                'may_terminate' => true,
            ),
        ),
    ),
    'controllers'            => array(
        'factories' => array(
            'MamuzContentManager\Controller\Query' => 'MamuzContentManager\Controller\QueryControllerFactory',
        ),
    ),
    'service_manager'        => array(
        'factories' => array(
            'MamuzContentManager\DomainManager' => 'MamuzContentManager\DomainManager\Factory',
        ),
    ),
    'content_manager_domain' => array(
        'factories' => array(
            'MamuzContentManager\Service\Query' => 'MamuzContentManager\Service\QueryFactory',
        ),
    ),
    'view_manager'           => array(
        'template_map'        => include __DIR__ . '/../template_map.php',
        'template_path_stack' => array(__DIR__ . '/../view'),
    ),
    'doctrine'               => array(
        'driver' => array(
            'mamuz_content_manager_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/MamuzContentManager/Entity'),
            ),
            'orm_default'                    => array(
                'drivers' => array(
                    'MamuzContentManager\Entity' => 'mamuz_content_manager_entities',
                ),
            ),
        ),
    ),
);
