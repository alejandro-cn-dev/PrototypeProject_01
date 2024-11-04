<?php
// use Cache;
// use App\Helpers;
//$aux = SystemValuesService::class;
//$configValues = json_decode(file_get_contents('C:\xampp\htdocs\WMS_WebSystem_01\app\SystemValues.json'), true);
return [
    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    //'title' => 'Sistema Web | '.$sistema->get('nombre_sistema').' | v6.1',
    //'title' => 'Sistema Web | '.$b['nombre_sistema'].' | v6.1',
    //'XD' => 'NOO',
    //'title' => 'Presitex',
    //'title' => 'Sistema Web | '.$configValues['nombre_sistema'].' | v7',
    //'title' => 'Sistema Web | '.$a->getValues()->value('nombre_sistema').' | v6.1',
    //'title' => 'Sistema Web | '.DatosClass::obtenerDatos().' | v7',
    //'title' => function () {
    //     //return new SystemValuesService();
    //     $systemValuesService = app()->make('SystemValuesService');
    //     return $systemValuesService->getValues();
    // },

    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    //'logo' => '<b>Presitex</b>',
    //'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    //'logo_img' => 'img/logo_p.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'System Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            //'path' => 'img/logo_p.png',
            'alt' => 'System Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'img/logo_p.png',
            'alt' => 'Preloader Image',
            'effect' => 'animation__shake',
            'width' => 100,
            'height' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-danger elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    //'dashboard_url' => 'home',
    'dashboard_url' => 'inicio',
    'logout_url' => 'logout',
    //'logout_url' => 'inicio',
    'login_url' => 'login',
    //'register_url' => 'register',
    'register_url' => '',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'Buscar...',
            'topnav_right' => false,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        // [
        //     'type' => 'sidebar-menu-search',
        //     'text' => 'Buscar...',
        // ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        // ['header' => 'Configuracion de compras y ventas'],
        // [
        //     'text' => 'Gestion de compras',
        //     'icon'    => 'fas fa-fw fa-arrow-down',
        //     'url'  => 'compras',
        //     'can'   => 'compras.index'
        // ],
        // [
        //     'text' => 'Gestion de ventas',
        //     'icon'    => 'fas fa-fw fa-arrow-up',
        //     'url'  => 'ventas',
        //     'can'   => 'ventas.index'
        // ],
        [
            'text'        => 'Inicio del panel',
            'url'         => 'home',
            'icon'    => 'fas fa-fw fa-home',
        ],
        [
            'text'        => 'Administración',
            'icon'    => 'fas fa-fw fa-lock',
            'can'   =>  'empleados.index',
            'submenu'   => [
                [
                    'text'        => 'Usuarios',
                    'url'         => 'empleados',
                    'icon'    => 'fas fa-fw fa-users',
                    //'can'   => 'empleados.index',
                ],
                [
                    'text'        => 'Parámetros',
                    'url'         => 'config',
                    'icon'    => 'fas fa-fw fa-cog',
                    'can'   => 'panel-config-admin'
                ],
                [
                    'text'        => 'Copia de seguridad',
                    'url'         => 'backup',
                    'icon'    => 'fa fa-database',
                    'can'   => 'panel-backup-admin'
                ],
                [
                    'text'        => 'Opciones avanzadas',
                    'url'         => 'dev',
                    'icon'    => 'fa fa-code',
                    'can'   => 'panel-config-dev'
                ]

            ],
        ],
        [
            'text'    => 'Gestion de productos',
            'icon'    => 'fas fa-fw fa-box',
            'can'   => 'productos.index',
            'submenu' => [
                [
                    'text' => 'Productos',
                    'url'  => 'productos',
                    'icon'    => 'fas fa-fw fa-box',
                    'can'   => 'productos.index'
                ],
                [
                    'text' => 'Categorias',
                    'icon'    => 'fas fa-fw fa-tags',
                    'url'  => 'categorias',
                    'can'   => 'categorias.index'
                ],
                [
                    'text' => 'Marcas',
                    'icon'    => 'fas fa-fw fa-trademark',
                    'url'  => 'marcas',
                    'can'   => 'marcas.index'
                ],
                [
                    'text' => 'Almacenes',
                    'icon'    => 'fas fa-fw fa-store',
                    'url'  => 'almacenes',
                    'can'   => 'almacens.index'
                ],

                [
                    'text' => 'Proveedores',
                    'icon'    => 'fas fa-fw fa-users',
                    'url'  => 'proveedores',
                    'can'   => 'proveedores.index'
                ],
            ],
        ],
        // [
        //     'text'        => 'Gestion de Usuarios',
        //     'url'         => 'empleados',
        //     'icon'    => 'fas fa-fw fa-users',
        //     'can'   => 'empleados.index',
        // ],
        [
            'text'    => 'Compras y ventas',
            'icon'    => 'fas fa-fw fa-book',
            'submenu' => [
                [
                    'text' => 'Gestion de compras',
                    'icon'    => 'fas fa-fw fa-arrow-down',
                    'url'  => 'compras',
                    'can'   => 'compras.index'
                ],
                [
                    'text' => 'Gestion de ventas',
                    'icon'    => 'fas fa-fw fa-arrow-up',
                    'url'  => 'ventas',
                    'can'   => 'ventas.index'
                ]
            ],
        ],
        [
            'text'    => 'Control de stock',
            'icon'    => 'fa fa-check-square',
            'submenu' => [
                [
                    'text' => 'Movimientos de inventario',
                    'icon'    => 'fas fa-fw fa-list-alt',
                    'url'  => 'inventario',
                    'can'   => 'ventas.movimientos'
                ],
                [
                    'text' => 'Existencias',
                    'icon'    => 'fas fa-edit',
                    'url'  => 'existencias',
                    'can'   => 'ventas.existencias'
                ]
            ],
        ],
        [
            'text'    => 'Reportes',
            'icon'    => 'fas fa-fw fa-file-pdf',
            'can'   => 'reporte.control_stock',
            'submenu' => [
                [
                    'text' => 'Control kardex',
                    'icon'    => 'fas fa-fw fa-file-text',
                    'url'  => 'kardex',
                    'can'   => 'reporte.control_stock'
                ],
                [
                    'text' => 'Ficha kardex',
                    'icon'    => 'fas fa-fw fa-book',
                    'url'  => 'ficha_kardex',
                    'can'   => 'reporte.control_stock'
                ],
                // [
                //     'text' => 'Stock',
                //     'icon'    => 'fas fa-fw fa-list-alt',
                //     'url'  => 'reporte_stock',
                //     'can'   => 'reportes.index'
                // ],
                [
                    'text' => 'Valoracion de inventarios',
                    'icon'    => 'fas fa-fw fa-file-alt',
                    'url'  => 'reporte_valoracion',
                    'can'   => 'reporte.valoracion'
                ],
                [
                    'text' => 'Ventas por productos',
                    'icon'    => 'fas fa-fw fa-file-alt',
                    'url'  => 'reporte_ventas',
                    'can'   => ''
                ],
                [
                    'text' => 'Todas las ventas',
                    'icon'    => 'fas fa-fw fa-file-alt',
                    'url'  => 'reporte_ventas_detalle',
                    'can'   => ''
                ]
            ],
        ],
        [
            'text'        => 'Volver a la Home',
            'url'         => 'inicio',
            'icon'    => 'fas fa-fw fa-undo'
        ],
        // ['header' => 'Configuracion de parámetros', 'can' => 'panel-config-admin'],
        // [
        //     'text'        => 'Parámetros',
        //     'url'         => 'config',
        //     'icon'    => 'fas fa-fw fa-cog',
        //     'can'   => 'panel-config-admin'
        // ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                // JQuery
                // InputMask
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js',
                ],
                // JQuery validate
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js',
                ],
                // Datatable
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs4/dt-1.13.5/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs4/dt-1.13.5/datatables.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    // 'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                    'location' => '//unpkg.com/sweetalert/dist/sweetalert.min.js',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,

    'ADMINLTE_CHANGE_LANGUAGE_ENDPOINT' => 'es'
];
