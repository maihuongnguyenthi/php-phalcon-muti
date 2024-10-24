<?php
use Phalcon\Config\Config;

return new Config([
    'database' => [
        'adapter'     => 'PostgreSQL',
        'host'        => 'postgres_db',
        'username'    => 'postgres',
        'password'    => 'postgres',
        'dbname'      => 'db',
        'charset'     => 'utf8',
    ],
    'application' => [
        'viewsDir'       => APP_PATH . '/views/',
        'baseUri'        => '/',
        'modules'        => [
            'frontend' => [
                'className' => 'App\Modules\Frontend\Module',
                'path'      => APP_PATH . '/modules/frontend/Module.php'
            ],
            'backend' => [
                'className' => 'App\Modules\Backend\Module',
                'path'      => APP_PATH . '/modules/backend/Module.php'
            ],
            'user' => [
                'className' => 'App\Modules\User\Module',
                'path'      => APP_PATH . '/modules/user/Module.php'
            ],
            'product' => [
                'className' => 'App\Modules\Product\Module',
                'path'      => APP_PATH . '/modules/product/Module.php'
            ]
        ]
    ]
]);
?>