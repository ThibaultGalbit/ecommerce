<?php


namespace App\Controller;


use App\Entity\Categorie;
use App\Entity\ProductEntity;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products/create", name="product_create")
     */
    public function createProduct() : Response
    {
        //A PASSER DYNAMIQUEMENT
        $em = $this->getDoctrine()->getManager();

        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->find(1);

        $product = new ProductEntity();
        $product->setCategory($categorie);
        $product->setLibelle("skywalker");
        $product->setPrice(5);

        $em->persist($product);
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/products", name="product_list")
     */
    public function getListProduct() {

        $allProducts = $this->getDoctrine()->getRepository(ProductEntity::class)->findAll();

        $libelle = [];
        $price = [];
        foreach ($allProducts as $product) {
           $libelle[] = $product->getLibelle();
           $price[] = $product->getPrice();
        }
        return $this->render("product.html.twig", [
            'products' => $libelle,
            'prices' => $price
        ]);
    }
}
