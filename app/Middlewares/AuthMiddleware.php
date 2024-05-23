<?php

namespace App\Middlewares;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, callable $next)
    {
        // Verifica se o usuário está autenticado
        if (!isset($_SESSION['user'])) {
            return new RedirectResponse('login', 302);
        }

        // Se o usuário estiver autenticado, passa a requisição adiante
        return $next($request);
    }
}
