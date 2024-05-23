<?php

require '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Middlewares\AuthMiddleware;
use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

// Iniciar sessão
session_start();

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_DATABASE'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Configuração das rotas
$routes = require '../app/routes.php';

$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);
$resolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

// Aplicar middleware às rotas protegidas
$authMiddleware = new AuthMiddleware();

try {
    $parameters = $matcher->match($request->getPathInfo());
    $request->attributes->add($parameters);

    $controller = $resolver->getController($request);
    if (!$controller) {
        throw new NotFoundHttpException('Controller not found');
    }

    $action = $parameters['_route'];
    $protectedRoutes = [
        'dashboard', 'orders'
        // Adicione outras rotas que precisam de autenticação aqui
    ];

    if (in_array($action, $protectedRoutes)) {
        $response = $authMiddleware->handle($request, function($request) use ($controller, $argumentResolver) {
            $arguments = $argumentResolver->getArguments($request, $controller);
            return call_user_func_array($controller, $arguments);
        });
    } else {
        $arguments = $argumentResolver->getArguments($request, $controller);
        $response = call_user_func_array($controller, $arguments);
    }
} catch (NotFoundHttpException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    $response = new Response('An error occurred: ' . $e->getMessage(), 500);
}

$response->send();
