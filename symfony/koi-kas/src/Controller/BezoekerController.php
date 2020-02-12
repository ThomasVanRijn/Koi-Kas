<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage() {
        return $this->render("bezoeker/home.html.twig");
    }

    /**
     * @Route("/koi-dokter", name="koi-dokter")
     */
    public function koiDokter() {
        return $this->render("bezoeker/koi-dokter.html.twig");
    }

    /**
     * @Route("/het-bedrijf", name="het-bedrijf")
     */

    public function hetBedrijf() {
        return $this->render("bezoeker/het-bedrijf.html.twig");
    }

    /**
     * @Route("/aanbeiding", name="aanbieding")
     */

    public function aanbieding() {
        return $this->render("bezoeker/aanbieding.html.twig");
    }

    /**
     * @Route("koi-info", name="koi-info")
     */

    public function koiInfo() {
        return $this->render("bezoeker/koi-info.html.twig");
    }

    /**
     * @Route("/koi-te-koop", name="koi-te-koop")
     */

    public function koiTeKoop() {
        return $this->render("bezoeker/koi-te-koop.html.twig");
    }

    /**
     * @Route("/japan-reizen", name="japan-reizen")
     */

    public function japanReizen() {
        return $this->render("bezoeker/japan-reizen.html.twig");
    }

    /**
     * @Route("/vijvers", name="vijvers")
     */

    public function vijvers() {
        return $this->render("bezoeker/vijvers.html.twig");
    }

    /**
     * @Route("/contact", name="contact")
     */

    public function contact() {
        return $this->render("bezoeker/contact.html.twig");
    }

    /**
     * @Route("/KadoBon", name="kadobon")
     */

    public function kadobon() {
        return $this->render("bezoeker/kadobon.html.twig");
    }

    /**
     * @Route("/links", name="links")
     */

    public function links() {
        return $this->render("bezoeker/links.html.twig");
    }

    /**
     * @Route("/producten", name="producten")
     */
    public function producten() {
        return $this->render("bezoeker/producten.html.twig");
    }




}