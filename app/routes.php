<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    '_controller' => 'App\Controllers\HomeController::index'
]));
$routes->add('login', new Route('/login', [
    '_controller' => 'App\Controllers\AuthController::login'
]));
$routes->add('logout', new Route('/logout', [
    '_controller' => 'App\Controllers\AuthController::logout'
]));
$routes->add('register', new Route('/register', [
    '_controller' => 'App\Controllers\AuthController::register'
]));
$routes->add('dashboard', new Route('/dashboard', [
    '_controller' => 'App\Controllers\DashboardController::index'
]));

# Users Routes
$routes->add('user_index', new Route('/users', [
    '_controller' => 'App\Controllers\UserController::index',
]));
$routes->add('user_create', new Route('/users/create', [
    '_controller' => 'App\Controllers\UserController::create',
]));
$routes->add('user_edit', new Route('/users/{id}/edit', [
    '_controller' => 'App\Controllers\UserController::edit'
]));
$routes->add('user_delete', new Route('/users/{id}/delete', [
    '_controller' => 'App\Controllers\UserController::delete',
]));
$routes->add('user_show', new Route('/users/{id}', [
    '_controller' => 'App\Controllers\UserController::show',
]));

# Orders Routes
$routes->add('orders', new Route('/orders', [
    '_controller' => 'App\Controllers\OrderController::index'
]));
$routes->add('orders_last', new Route('/orders/last', [
    '_controller' => 'App\Controllers\OrderController::last'
]));
$routes->add('orders_create', new Route('/orders/create', [
    '_controller' => 'App\Controllers\OrderController::create',
]));
$routes->add('orders_edit', new Route('/orders/{id}/edit', [
    '_controller' => 'App\Controllers\OrderController::edit'
]));
$routes->add('orders_delete', new Route('/orders/{id}/delete', [
    '_controller' => 'App\Controllers\OrderController::delete',
]));
$routes->add('orders_show', new Route('/orders/{id}', [
    '_controller' => 'App\Controllers\OrderController::show',
]));

return $routes;
