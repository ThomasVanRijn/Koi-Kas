<?php


namespace App\Controller;


use App\Entity\Categorie;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class ProductenController extends AbstractController
{

    /**
     * @Route("/producten/{id}", name="product")
     */

    public function product($id) {
        $em = $this->getDoctrine()->getManager();
        $producten = $em->getRepository(Categorie::class)->findBy([
            'naam' => $id
        ]);
        $producten = $producten[0];
        $product = $producten->getProducts();
        return $this->render('bezoeker/producten.html.twig', [
            'producten' => $product
        ]);
    }

    /**
     * @Route("/producten", name="producten")
     */

    public function producten() {
        $em = $this->getDoctrine()->getManager();
        $producten = $em->getRepository(Product::class)->findAll();
        return $this->render("bezoeker/producten.html.twig", [
            'producten' => $producten
        ]);
    }



}