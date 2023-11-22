<?php
// config/app_settings.php
return [
    'logo' => 'storage/images/app/guzanet.png',
    'titulo' => 'Guzanet',
    'Vers' => '1.0.1',

    'menus' => [
        // JobTime 30000
        [
            'id' => 30000,
            'nombre' => 'JobTime',
            'url' => null,
            'is_active' => true,
            'icon' => 'chevron-down',
            'submenu' => [
                [
                    'id' => 30100,
                    'nombre' => 'Clientes',
                    'url' => '/JobTime/clientes',
                    'is_active' => true,
                    'icon' => 'collection',
                    // 'submenu' => [
                    //     [
                    //         'nombre' => 'Nuevo',
                    //         'url' => '/JobTime/clientes/new',
                    //         'is_active' => true,
                    //         'icon' => 'collection',
                    //     ], [
                    //         'nombre' => 'Editar',
                    //         'url' => '/JobTime/clientes/edit',
                    //         'is_active' => true,
                    //         'icon' => 'collection',
                    //     ], [
                    //         'nombre' => 'Eliminar',
                    //         'url' => '/JobTime/clientes/delete',
                    //         'is_active' => true,
                    //         'icon' => 'collection',
                    //     ],
                    // ],
                ],
                [
                    'id' => 30200,
                    'nombre' => 'Proyecto',
                    'url' => '/JobTime/proyecto',
                    'is_active' => true,
                    'icon' => 'chart-square-bar',
                ],
            ]
        ],

        // Banca 50000
        [
            'id' => 50000,
            'nombre' => 'Banca',
            'url' => null,
            'is_active' => true,
            'icon' => 'chevron-down',
            'submenu' => [
                [
                    'id' => 50100,
                    'nombre' => 'Traspasos',
                    'url' => '/banca/traspasos',
                    'is_active' => true,
                    'icon' => 'cloud-download',
                ],
                [
                    'id' => 50200,
                    'nombre' => 'Clientes',
                    'url' => '/banca/clientes',
                    'is_active' => true,
                    'icon' => 'collection',
                ],
            ]
        ],
        // Blog 60000
        [
            'id' => 60000,
            'nombre' => 'Blog',
            'url' => '/blog',
            'is_active' => true,
            'icon' => 'annotation',
        ],
        //
        // Tablas 1000
        [
            'id' => 1000,
            'nombre' => 'Tablas',
            'url' => null,
            'is_active' => true,
            'icon' => 'chevron-down',
            'submenu' => [
                [
                    'id' => 1100,
                    'nombre' => 'Categorias',
                    'url' => '/categorias',
                    'is_active' => true,
                    'icon' => 'tag',
                ],
                [
                    'id' => 1200,
                    'nombre' => 'Marcadores',
                    'url' => '/marcadores',
                    'is_active' => true,
                    'icon' => 'bookmark',
                ],
                [
                    'id' => 1300,
                    'nombre' => 'Proyecto',
                    'url' => '/tablas/13000',
                    'is_active' => true,
                    'icon' => 'information-circle',
                ],
                [
                    'id' => 1500,
                    'nombre' => 'Configuraciones',
                    'url' => '/tablas',
                    'is_active' => true,
                    'icon' => 'cog',
                ],
                [
                    'id' => 1600,
                    'nombre' => 'Banca - cuentas',
                    'url' => '/tablas/50000',
                    'is_active' => true,
                    'icon' => 'currency-euro',
                ],
                [
                    'id' => 1700,
                    'nombre' => 'Iconos',
                    'url' => '/iconos',
                    'is_active' => true,
                    'icon' => 'information-circle',
                ],
                [
                    'id' => 1800,
                    'nombre' => 'To Do',
                    'url' => '/todo',
                    'is_active' => true,
                    'icon' => 'information-circle',
                ],
                [
                    'id' => 1900,
                    'nombre' => '',
                    'url' => '/',
                    'is_active' => false,
                    'icon' => 'information-circle',
                ],
            ],
        ],
        // Usuarios
        [
            'id' => 2000,
            'nombre' => 'Usuarios',
            'url' => null,
            'is_active' => true,
            'icon' => 'users',
            'submenu' => [
                [
                    'id' => 2100,
                    'nombre' => 'Usuarios',
                    'url' => '/admin/usuarios',
                    'is_active' => true,
                    'icon' => 'user',
                ],
                [
                    'id' => 2200,
                    'nombre' => 'Roles',
                    'url' => '/admin/roles',
                    'is_active' => false,
                    'icon' => 'cube',
                ],
                [
                    'id' => 2300,
                    'nombre' => 'Permisos',
                    'url' => '/admin/permisos',
                    'is_active' => true,
                    'icon' => 'cube-transparent',
                ],
            ],
        ],
        // acerca de...
        [
            'id' => 3000,
            'nombre' => 'Acerca de',
            'url' => '/acercade',
            'is_active' => true,
            'icon' => 'heart',
        ],
        // Agrega más elementos de menú según sea necesario

    ],
    'codigo_categorias' => 2000,
    'niveles_categorias' => 3,
    'categorias' => [
        [
            'nombre' => 'Computación',
            'is_active' => true,
            'subcategoria' => [
                [
                    'nombre' => 'Monitor',
                    'is_active' => true,
                ],
                [
                    'nombre' => 'Impresora',
                    'is_active' => true,
                ],
                [
                    'nombre' => 'Router',
                    'is_active' => true,
                ],
                [
                    'nombre' => 'Scaner',
                    'is_active' => true,
                ],
            ],
        ],
        [
            'nombre' => 'Video',
            'is_active' => true,
            'subcategoria' => [
                [
                    'nombre' => 'Televisor',
                    'is_active' => true,
                ],
                [
                    'nombre' => 'Proyector',
                    'is_active' => true,
                ],
                [
                    'nombre' => 'Cámara video',
                    'is_active' => true,
                ],
                [
                    'nombre' => 'DVD',
                    'is_active' => true,
                    'subcategoria' => [
                        [
                            'nombre' => '60 min',
                            'is_active' => true,
                        ],
                        [
                            'nombre' => '90 min',
                            'is_active' => true,
                        ],
                    ],
                ],
            ],
        ],
    ],
    'tabs-users' => [
        [
            'title' => 'Listado',
            'sufix' => 'tab-listado',
            'component' => 'live-list',
        ],
        [
            'title' => 'Usuario',
            'sufix' => 'tab-usuario',
            'component' => 'live-form',
        ],
        [
            'title' => 'Roles',
            'sufix' => 'tab-roles',
            'component' => 'live-list',
        ],
        [
            'title' => 'Permisos',
            'sufix' => 'tab-permisos',
            'component' => 'live-form',
        ],
    ],
];
