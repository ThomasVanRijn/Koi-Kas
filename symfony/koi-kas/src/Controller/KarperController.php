<?php

namespace App\Controller;

use App\Entity\Karper;
use App\Form\KarperType;
use App\Repository\KarperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/karper")
 */
class KarperController extends AbstractController
{
    /**
     * @Route("/", name="karper_index", methods={"GET"})
     */
    public function index(KarperRepository $karperRepository): Response
    {
        return $this->render('karper/index.html.twig', [
            'karpers' => $karperRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="karper_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $karper = new Karper();
        $form = $this->createForm(KarperType::class, $karper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($karper);
            $entityManager->flush();

            return $this->redirectToRoute('karper_index');
        }

        return $this->render('karper/new.html.twig', [
            'karper' => $karper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="karper_show", methods={"GET"})
     */
    public function show(Karper $karper): Response
    {
        return $this->render('karper/show.html.twig', [
            'karper' => $karper,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="karper_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Karper $karper): Response
    {
        $form = $this->createForm(KarperType::class, $karper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('karper_index');
        }

        return $this->render('karper/edit.html.twig', [
            'karper' => $karper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="karper_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Karper $karper): Response
    {
        if ($this->isCsrfTokenValid('delete'.$karper->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($karper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('karper_index');
    }
}
