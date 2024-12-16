<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('api', ['filter' => 'cors'], static function (RouteCollection $routes) {
    $routes->resource('product', ['controller' => 'ProductController', 'except' => ['new', 'edit'], 'placeholder' => '(:num)']);

    $routes->options('product', static function () {
        $response = response();
        $response->setStatusCode(204);
        $response->setHeader('Allow:', 'OPTIONS, GET, POST, PUT, PATCH, DELETE');

        return $response;
    });
    $routes->options('product/(:any)', static function () {});
});
