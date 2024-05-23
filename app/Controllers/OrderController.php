<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Models\Order;
use App\Models\User;
use App\Handlers\FormHandler;
use App\Handlers\FormatDataHandler;

class OrderController extends BaseController
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
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return new Response($this->renderTemplate('orders/show.twig', [
            'orders' => $orders, 
            'queryparams' => $request->query->all()
        ]));
    }

    public function show($id)
    {
        $orders = Order::find($id);
        return new Response($this->renderTemplate('orders/form.twig', [
            'orders' => $orders
        ]));
    }

    public function last()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->take(10)->get();
        return new Response($this->renderTemplate('orders/showlast.twig', [
            'orders' => $orders
        ]));
    }

    public function create(Request $request)
    {
        $datapost = null;

        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            try {

                $formattedData = $this->formHandler->formatData($data);
                $datapost = Order::create($formattedData);
                if(is_numeric($datapost->id)){
                    return new RedirectResponse('/orders?success_register=true', 302);
                }

            } catch (\InvalidArgumentException $e) { 
                return new Response($this->twig->render('register.twig', [
                    'error' => $e->getMessage()
                ]));
            }
        }

        $clientes = User::all();
        return new Response($this->renderTemplate('orders/form.twig', [ 
            'queryparams' => $request->query->all(),
            'clientes' => $clientes
        ]));
    }

    public function edit(Request $request, $id)
    {
        $orders = Order::with('user')->find($id);
        
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            try {

                $formattedData = $this->formHandler->formatData($data);
                if($orders->update($formattedData)){
                    return new RedirectResponse('/orders?success_update=true', 302);
                }

            } catch (\InvalidArgumentException $e) { 
                return new Response($this->twig->render('register.twig', [
                    'error' => $e->getMessage()
                ]));
            }
        }

        $clientes = User::all();
        $formattedData = $this->formatDataHandler->formatData($orders);
        return new Response($this->renderTemplate('orders/form.twig', [ 
            'queryparams' => $request->query->all(),
            'order' => $formattedData,
            'clientes' => $clientes
        ]));
    }

    public function delete($id)
    {
        $orders = Order::find($id);
        $orders->delete();
        return new RedirectResponse('/orders?success_delete=true', 302);
    }
}
