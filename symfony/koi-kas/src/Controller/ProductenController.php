<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/producten")
 */

class ProductenController extends AbstractController
{

    /**
     * @Route("/pompen", name="pompen")
     */
    public function pompen() {
        return $this->render('bezoeker/japan-reizen.html.twig');
    }

    /**
     * @Route("/filters", name="filters")
     */
    public function filters() {
        return $this->render('');
    }

    /**
     * @Route("/filter-materialen", name="filter_materialen")
     */
    public function filter_materialen() {
    }

    /**
     * @Route("/folie", name="folie")
     */
    public function folie(){

    }

    /**
     * @Route("/verlichting", name="verlichting")
     */
    public function verlichting() {

    }

    /**
     * @Route("/verwarming", name="verwarming")
     */
    public function verwarming() {

    }

    /**
     * @Route("/accesoires", name="accesoires")
     */
    public function accesoires() {

    }

    /**
     * @Route("/voer", name="voer")
     */
    public function voer() {

    }

    /**
     * @Route("/medicijnen", name="medicijnen")
     */
    public function medicijnen() {

    }

    /**
     * @Route("/waterconditie", name="waterconditie")
     */
    public function waterconditie() {

    }

    /**
     * @Route("/gebruikt-showmodellen", name="gebruikt_showmodellen")
     */
    public function gebruikt() {

    }

    /**
     * @Route("/catalogusMessner", name="catalogus")
     */
    public function catalogus() {

    }


}