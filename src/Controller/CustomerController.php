<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $customer = $entityManager
            ->getRepository(Customer::class)
            ->find(1);

        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
            'customer' => $customer,
        ]);
    }

    #[Route('/customer/new', name: 'app_customer_new')]
    public function new(EntityManagerInterface $entityManager, Request $request): Response
    {
        $customer = new Customer();

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();
        }

        return $this->render('customer/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
