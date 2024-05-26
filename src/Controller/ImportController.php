<?php

namespace App\Controller;

use App\Form\FileUploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Laravie\Parser\Xml\Reader;
use Laravie\Parser\Xml\Document;

use App\Entity\Product;

class ImportController extends AbstractController
{
    #[Route('/get/form', name: 'import_form')]
    public function importForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FileUploadType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();

            $xmlFile = (new Reader(new Document()))->load($file)->getContent();

            foreach ($xmlFile as $singleRecord) {
                $arrayRecords = (array)$singleRecord;
                $product = new Product();
                $product->setName($arrayRecords['name']);
                $product->setDescription($arrayRecords['description']);
                $product->setWeight($arrayRecords['weight']);
                $product->setCategory($arrayRecords['category']);
                $entityManager->persist($product);
            }
            // TODO : Importing the Other Type oF XML with Newer keys  ;
        }
        $entityManager->flush();
        return $this->render('import_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
