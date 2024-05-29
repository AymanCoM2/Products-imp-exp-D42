<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ExportController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/export-data', name: 'export_data')]
    public function exportData(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        $csvData = [];
        foreach ($products as $product) {
            $csvData[] = [
                $product->getName(),
                $product->getWeight(),
                $product->getDescription(),
                $product->getDescriptionCommon(),
                $product->getDescriptionForOzon(),
                $product->getDescriptionForWildberries(),
                $product->getCategory(),
            ];
        }

        $csvContent = $this->arrayToCsv($csvData);

        return new Response(
            $csvContent,
            Response::HTTP_OK,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="exportData.csv"',
            ]
        );
    }

    protected function arrayToCsv(array $data)
    {
        $output = fopen('php://temp', 'r+'); // TODO : somewhere else
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);
        return $csvContent;
    }
}
