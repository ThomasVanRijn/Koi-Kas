<?php

namespace App\Controller;

use App\Entity\Kweker;
use App\Form\KwekerType;
use App\Repository\KwekerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kweker")
 */
class KwekerController extends AbstractController
{
    /**
     * @Route("/", name="kweker_index", methods={"GET"})
     */
    public function index(KwekerRepository $kwekerRepository): Response
    {
        return $this->render('kweker/index.html.twig', [
            'kwekers' => $kwekerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="kweker_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kweker = new Kweker();
        $form = $this->createForm(KwekerType::class, $kweker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kweker);
            $entityManager->flush();

            return $this->redirectToRoute('kweker_index');
        }

        return $this->render('kweker/new.html.twig', [
            'kweker' => $kweker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kweker_show", methods={"GET"})
     */
    public function show(Kweker $kweker): Response
    {
        return $this->render('kweker/show.html.twig', [
            'kweker' => $kweker,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kweker_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kweker $kweker): Response
    {
        $form = $this->createForm(KwekerType::class, $kweker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kweker_index');
        }

        return $this->render('kweker/edit.html.twig', [
            'kweker' => $kweker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kweker_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Kweker $kweker): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kweker->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kweker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kweker_index');
    }
}
