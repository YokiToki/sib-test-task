<?php
/**
 * Created by PhpStorm.
 * User: tamat
 * Date: 10.07.18
 * Time: 10:17
 */

require __DIR__ . '/../vendor/autoload.php';

$router = new App\Router();

$router->add('/', [
    App\Controllers\HomeController::class,
    'index'
]);

$router->add('/api/search/{query}', [
    App\Controllers\SearchController::class,
    'search'
]);

$router->run();
