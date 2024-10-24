<?php
    use Phalcon\Mvc\Application;
    use Phalcon\Di\FactoryDefault;
    
    define('BASE_PATH', dirname(__DIR__) . '/html');
    define('APP_PATH', BASE_PATH . '/app');
    
    $di = new FactoryDefault();
   
    include APP_PATH . "/config/services.php";
    include APP_PATH . "/config/router.php";

    $config = $di->getConfig();

    $application = new Application($di);
    
    $application->registerModules([
        'user' => [
            'className' => \App\Modules\User\Module::class,
            'path'      => APP_PATH . '/modules/user/Module.php'
        ],
        'product' => [
            'className' => \App\Modules\Product\Module::class,
            'path'      => APP_PATH . '/modules/product/Module.php'
        ],
        'frontend' => [
            'className' => 'App\Modules\Frontend\Module',
            'path'      => APP_PATH . '/modules/frontend/Module.php'
        ],
        'backend' => [
            'className' => \App\Modules\Backend\Module::class,
            'path'      => APP_PATH . '/modules/backend/Module.php'
        ]

    ]);

    try {
        $response = $application->handle($_SERVER['REQUEST_URI']);

        $response->send();
        
    } catch (\Exception $e) {
        echo 'Exception: ', $e->getMessage();
    }