<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Bridge\Twig\Extension\RoutingExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use App\Models\User;

class BaseController
{
    protected $twig;
    protected $generator;
    protected $context;
    protected $loggedUser;

    public function __construct()
    {
        // Configuração do Twig
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);

        // Configuração do Asset Component
        $package = new PathPackage('/', new EmptyVersionStrategy());
        $packages = new Packages($package);

        // Adicionar extensão de Asset ao Twig
        $this->twig->addExtension(new AssetExtension($packages));

        // Configurar o contexto da requisição
        $request = Request::createFromGlobals();
        $this->context = new RequestContext();
        $this->context->fromRequest($request);

        // Carregar as rotas
        $routes = require __DIR__ . '/../routes.php';
        $this->generator = new UrlGenerator($routes, $this->context);

        // Adicionar extensão de roteamento ao Twig
        $this->twig->addExtension(new RoutingExtension($this->generator));
        
    }

    public function renderTemplate(string $template, array $data = [])
    {
        if(isset($_SESSION['user'])){
            $user = User::find($_SESSION['user']);
        }
        
        $fullData = array_merge(['loggedUser' => $user], $data);

        return $this->twig->render($template, $fullData);
    }
}
