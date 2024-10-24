<?php 
namespace App\Modules\Backend;

use Phalcon\Di\DiInterface;
use Phalcon\Autoload\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Manager as ModelsManager;

use App\Modules\Backend\Models\Repository;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $loader->setNamespaces([
            'App\Modules\Backend\Controllers' => __DIR__ . '/controllers/',
            'App\Modules\Backend\Models'      => __DIR__ . '/models/',
        ]);
        $loader->register();
    }

    public function registerServices(DiInterface $di)
    {
        $di->set('dispatcher', function() {
            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setDefaultNamespace('App\Modules\Backend\Controllers');
            return $dispatcher;
        });

        $di->setShared('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(APP_PATH . '/views/');
        
            $view->registerEngines([
                '.volt' => function ($view) {
                    $volt = new VoltEngine($view, $this);
        
                    $volt->setOptions([
                        'always' => true,
                        'separator' => '_',
                        'stat' => true,
                        'path' => function ($templatePath) {
                            $dirName = str_replace(APP_PATH . "/", '', dirname($templatePath));
        
                            if (!is_dir('cache/' . $dirName)) {
                                mkdir('cache/' . $dirName, 0777, true);
                            }
        
                            return 'cache/' . $dirName . '/' . basename($templatePath) . '.php';
                        },
                    ]);
        
                    return $volt;
                },
                '.phtml' => PhpEngine::class
            ]);
        
            return $view;
        });

        $di->set(
            "modelsManager",
            function() {
                return new ModelsManager();
            }
        );

        $di->setShared(
            "beRepo",
            function (){
                return new Repository();
            }
        );
        
    }
}