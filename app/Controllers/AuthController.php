<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Handlers\FormHandler;

class AuthController extends BaseController
{
    private $formHandler;

    public function __construct()
    {
        parent::__construct();
        $this->formHandler = new FormHandler();
    }

    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $email = $request->get('email');
            $password = base64_encode($request->get('password'));

            $user = User::where('email', $email)->first(); 
            if ($user && ($password === $user->pwd_hash)) {
                $_SESSION['user'] = $user->id;
                return new RedirectResponse('/dashboard', 302);
            }
            return new Response($this->twig->render('login.twig', [
                'data' => ['login_error' => true]
            ]));
        }
        return new Response($this->twig->render('login.twig', [
            'data' => $request->query->all()
        ]));
    }

    public function logout()
    {
        unset($_SESSION['user']);
        return new RedirectResponse('/login?logout=true', 302);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();

            try {

                $formattedData = $this->formHandler->formatData($data);
                User::create($formattedData);
                return new RedirectResponse('login?success_register=true', 302);

            } catch (\InvalidArgumentException $e) { 
                return new Response($this->twig->render('register.twig', ['error' => $e->getMessage()]));
            }
            
        }

        return new Response($this->twig->render('register.twig'));
    }
}
