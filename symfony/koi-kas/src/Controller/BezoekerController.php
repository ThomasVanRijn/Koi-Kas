<?php


namespace App\Controller;


use App\Entity\Categorie;
use App\Entity\Karper;
use App\Entity\Product;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render("bezoeker/home.html.twig");
    }

    /**
     * @Route("/producten", name="producten")
     */
    public function producten()
    {
        $em = $this->getDoctrine()->getManager();
        $producten = $em->getRepository(Product::class)->findAll();

        return $this->render("bezoeker/producten.html.twig", [
            'producten' => $producten
        ]);
    }

    /**
     * @Route("/producten/categorie/{naam}", name="product_categorie")
     */
    public function productenCategorie($naam)
    {
        $em = $this->getDoctrine()->getManager();
        $producten = $em->getRepository(Categorie::class)->findBy([
            'naam' => $naam
        ]);
        $producten = $producten[0];
        $product = $producten->getProducts();

        return $this->render('bezoeker/producten.html.twig', [
            'producten' => $product
        ]);
    }

    /**
     * @Route("/producten/categorie/{naam}/{id}", name="product_detail", methods={"GET","POST"})
     */
    public function productDetail($naam, Product $product, ProductRepository $productRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $overigeProducten = $em->getRepository(Categorie::class)->findBy([
            'naam' => $naam
        ]);
        $overigeProducten = $overigeProducten[0];
        $overigeProducten = $overigeProducten->getProducts();

        return $this->render('bezoeker/product-detail.html.twig', [
            'product' => $product,
            'producten' => $productRepository,
            'overigeProducten' => $overigeProducten
        ]);
    }

    /**
     * @Route("/koi-dokter", name="koi-dokter")
     */
    public function koiDokter()
    {
        return $this->render("bezoeker/koi-dokter.html.twig");
    }

    /**
     * @Route("/het-bedrijf", name="het-bedrijf")
     */
    public function hetBedrijf()
    {
        return $this->render("bezoeker/het-bedrijf.html.twig");
    }

    /**
     * @Route("/aanbeiding", name="aanbieding")
     */
    public function aanbieding()
    {
        return $this->render("bezoeker/aanbieding.html.twig");
    }

    /**
     * @Route("koi-info", name="koi-info")
     */
    public function koiInfo()
    {
        return $this->render("bezoeker/koi-info.html.twig");
    }

    /**
     * @Route("/japan-reizen", name="japan-reizen")
     */
    public function japanReizen()
    {
        return $this->render("bezoeker/japan-reizen.html.twig");
    }

    /**
     * @Route("/vijvers", name="vijvers")
     */
    public function vijvers()
    {
        return $this->render("bezoeker/vijvers.html.twig");
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render("bezoeker/contact.html.twig");
    }

    /**
     * @Route("/KadoBon", name="kadobon")
     */
    public function kadobon()
    {
        return $this->render("bezoeker/kadobon.html.twig");
    }

    /**
     * @Route("/links", name="links")
     */
    public function links()
    {
        return $this->render("bezoeker/links.html.twig");
    }


    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/Koi-Karper", name="koiKarper")
     */
    public function KoiKarper() {
        $em = $this->getDoctrine()->getManager();

        $producten = $em->getRepository(Karper::class)->findAll();

        return $this->render('bezoeker/koi-karper.html.twig', [
            'producten' => $producten
        ]);
    }


}