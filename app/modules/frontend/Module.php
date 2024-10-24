<?php
namespace App\Frontend;

use Phalcon\Di\DiInterface;
use Phalcon\Autoload\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->setNamespaces(
            [
                'App\Modules\Frontend\Controllers' => __DIR__ . '/controllers/',
                'App\Modules\Frontend\Models' => __DIR__ . '/models/',
            ]
        );

        $loader->register();
    }

    public function registerServices(DiInterface $di)
    {
        $di->set('dispatcher', function() {
            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setDefaultNamespace('App\Modules\Frontend\Controllers');
            return $dispatcher;
        });

        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');
            return $view;
        });
    }
}