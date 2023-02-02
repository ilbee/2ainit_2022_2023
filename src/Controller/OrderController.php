<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    #[Route('/order/new', name: 'app_order_new')]
    public function new(): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);

        return $this->render('order/new.html.twig', [
            'controller_name' => 'OrderController',
            'form'  => $form->createView(),
        ]);
    }
}
