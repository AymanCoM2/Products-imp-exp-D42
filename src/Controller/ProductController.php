<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use Knp\Component\Pager\PaginatorInterface;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'show_products')]
    public function showProducts(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('search', '');
        $sortBy = $request->query->get('sort_by', '');
        $queryBuilder = $entityManager->getRepository(Product::class)->createQueryBuilder('p');

        if ($searchTerm) {
            $queryBuilder->where('p.name LIKE :searchTerm OR p.description LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $searchTerm . '%');
        }

        switch ($sortBy) {
            case 'category':
                $queryBuilder->orderBy('p.category', 'ASC');
                break;
            case 'title':
                $queryBuilder->orderBy('p.name', 'ASC');
                break;
            default:
                $queryBuilder->orderBy('p.id', 'ASC'); // Default sorting by ID or any other default field
                break;
        }

        $query = $queryBuilder->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('show_products.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
