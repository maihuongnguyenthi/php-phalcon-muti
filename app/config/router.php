<?php
$router = $di->getRouter();

$router->addModuleResource('user', 'App\Modules\User\Controllers\Index', '/');
$router->addModuleResource('user', 'App\Modules\User\Controllers\Index', '/signup');
$router->addModuleResource('user', 'App\Modules\User\Controllers\Login', '/user');

$router->addModuleResource('product', 'App\Modules\Product\Controllers\Index', '/product');

$router->addModuleResource('backend', 'App\Modules\Backend\Controllers\Customer', '/admin/customer');
$router->addModuleResource('backend', 'App\Modules\Backend\Controllers\Product', '/admin/product');
?>
