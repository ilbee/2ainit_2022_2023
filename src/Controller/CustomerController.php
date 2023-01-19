<?php

namespace App\Controller;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
