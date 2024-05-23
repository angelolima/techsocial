<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Models\User;
use App\Handlers\FormHandler;
use App\Handlers\FormatDataHandler;

class UserController extends BaseController
{
    private $formHandler;

    private $formatDataHandler;

    public function __construct()
    {
        parent::__construct();
        $this->formHandler = new FormHandler();
        $this->formatDataHandler = new FormatDataHandler();
    }

    public function index(Request $request)
    {
        $users = User::all();
        return new Response($this->renderTemplate('users/show.twig', [
            'users' => $users, 
            'queryparams' => $request->query->all()
        ]));
    }

    public function show($id)
    {
        $user = User::find($id);
        return new Response($this->renderTemplate('users/form.twig', [
            'user' => $user
        ]));
    }

    public function create(Request $request)
    {
        $datapost = null;

        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            try {

                $formattedData = $this->formHandler->formatData($data);
                $datapost = User::create($formattedData);
                if(is_numeric($datapost->id)){
                    return new RedirectResponse('/users?success_register=true', 302);
                }

            } catch (\InvalidArgumentException $e) { 
                return new Response($this->twig->render('register.twig', [
                    'error' => $e->getMessage()
                ]));
            }
        }
        return new Response($this->renderTemplate('users/form.twig', [ 
            'queryparams' => $request->query->all()
        ]));
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            try {

                $formattedData = $this->formHandler->formatData($data);
                if($user->update($formattedData)){
                    return new RedirectResponse('/users?success_update=true', 302);
                }

            } catch (\InvalidArgumentException $e) { 
                return new Response($this->twig->render('register.twig', [
                    'error' => $e->getMessage()
                ]));
            }
        }

        $formattedData = $this->formatDataHandler->formatData($user);
        return new Response($this->renderTemplate('users/form.twig', [ 
            'queryparams' => $request->query->all(),
            'user' => $formattedData
        ]));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return new RedirectResponse('/users?success_delete=true', 302);
    }
}
