<?php


namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{

    /**
     * @Route("/api/productbybarcode",methods={"GET"})
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */

    public function getProductByBarcode (EntityManagerInterface  $entityManager, Request $request){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $barcode = $request->query->get('barcode');

        $repository = $entityManager->getRepository('App\Entity\Product');



        $data=$repository->findOneBy([
           'barcode' => $barcode
        ]);
        $jsonContent = $this->get('serializer')->serialize($data, 'json');

        $response = new JsonResponse();

        $response->setData([
            "data" => json_decode($jsonContent,true),
        ]);



        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_OK);


        return  $response;

    }
}
