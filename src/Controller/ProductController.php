<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Laravie\Parser\Xml\Reader;
use Laravie\Parser\Xml\Document;

use App\Entity\Product;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'show_products')]
    public function importForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        $products = $entityManager->getRepository(Product::class)->findAll();

        return $this->render('show_products.html.twig', [
            'products' => $products,
        ]);
    }
}
