<?php
    use Phalcon\Autoload\Loader;
    use Phalcon\Mvc\Router\Annotations as AnnotationsRouter;
    use Phalcon\Annotations\Adapter\Memory;
    use Phalcon\Html\Escaper;
    use Phalcon\Flash\Direct as Flash;
    use Phalcon\Mvc\Model\Manager as ModelsManager;
    use Phalcon\Session\Adapter\Stream as SessionAdapter;
    use Phalcon\Session\Manager as SessionManager;

    $loader = new Loader();
    $loader->setNamespaces(
        [
            'App\Config' => APP_PATH . '/config',
            'App\Modules' => APP_PATH . '/modules',

            'App\Modules\User\Controllers' => APP_PATH . '/modules/user/controllers',
            'App\Modules\User\Models\Customer' => APP_PATH . '/modules/user/models/customer',

            'App\Modules\Product\Controllers' => APP_PATH . '/modules/product/controllers',
            'App\Modules\Product\Models\Product' => APP_PATH . '/modules/product/models/product',
            
            'App\Modules\Backend\Controllers' => APP_PATH . '/modules/backend/controllers',
        ]
    );
    $loader->register();

    $di->setShared('config', function () {
        return include APP_PATH . "/config/config.php";
    });

    $di->setShared('db', function () {
        $config = $this->getConfig();
    
        $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
        $params = [
            'host'     => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname'   => $config->database->dbname
        ];
        return new $class($params);
    });

    $di->setShared('flash', function () {
        $escaper = new Escaper();
        $flash = new Flash($escaper);
        $flash->setImplicitFlush(false);
        $flash->setCssClasses([
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
    
        return $flash;
    });

    $di->setShared('session', function () {
        $session = new SessionManager();
        $files = new SessionAdapter([
            'savePath' => APP_PATH . "/tmp",
        ]);
        $session->setAdapter($files);
        $session->setOptions([
            'lifetime' => 60,
        ]);

        $session->start();

        return $session;
    });

    $di->set(
        "modelsManager",
        function() {
            return new ModelsManager();
        }
    );

    //gắn siêu dữ liệu vào một lớp
    //Memory() được sử dụng để lưu trữ dữ liệu annotation một cách tạm thời trong bộ nhớ ram
    $di->setShared(
        'annotations',
        function () {
            return new Memory();
        }
    );

    $di->setShared(
        'router',
        function () use ($di) {
            $router = new AnnotationsRouter(false);
            return $router;
        }
    );
?>