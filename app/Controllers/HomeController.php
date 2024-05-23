<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController extends BaseController
{

    public function index()
    {
        return new RedirectResponse('dashboard');
    }
}
