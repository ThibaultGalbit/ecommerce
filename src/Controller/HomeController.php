<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return Response
     * @Route("/home", name="home")
     */
    public function index() {
        $productName = "pomme";

        return $this->render('base.html.twig', [
            'product_name' => $productName
        ]);
    }
}
