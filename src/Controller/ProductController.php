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
        $product->setLibelle("tulipe fievre");
        $product->setPrice(93);
        $product->setPhoto("images/images.jpeg");

        $em->persist($product);
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/products", name="product_list")
     */
    public function getListProduct() {

        $allProducts = $this->getDoctrine()->getRepository(ProductEntity::class)->findAll();

        return $this->render("product.html.twig", [
            'products' => $allProducts
        ]);
    }

    /**
     * @param $entityId
     * @Route("/products/{entityId}", name="product_show")
     */
    public function showProduct($entityId) {
        $entity = $this->getDoctrine()->getRepository(ProductEntity::class)->find($entityId);
        return $this->render("show_product.html.twig",[
            'product_details' => $entity
        ]);
    }
}
