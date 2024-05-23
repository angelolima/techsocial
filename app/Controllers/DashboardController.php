<?php

namespace App\Controllers;

use App\Models\User;
use App\Controllers\Auth;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends BaseController
{
    public function index(Request $request)
    {
        $user = User::find($_SESSION['user']);
        return new Response($this->renderTemplate('dashboard.twig', [
            'queryparams' => $request->query->all()
        ]));
    }
}
