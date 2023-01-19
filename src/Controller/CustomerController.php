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
        $customers = $entityManager
            ->getRepository(Customer::class)
            ->findAll();

        return $this->render('customer/list.html.twig', [
            'customers' => $customers,
        ]);
    }

    #[Route('/customer/view/{id}', name: 'app_customer_view')]
    public function view(EntityManagerInterface $entityManager, int $id): Response
    {
        $customer = $entityManager
            ->getRepository(Customer::class)
            ->find($id);

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

            return $this->redirectToRoute('app_customer_view', ['id' => $customer->getId()]);
        }

        return $this->render('customer/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
