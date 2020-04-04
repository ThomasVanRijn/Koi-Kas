<?php

namespace App\Controller;

use App\Entity\BlogImage;
use App\Form\BlogImageType;
use App\Repository\BlogImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/test/image")
 */
class BlogImageController extends AbstractController
{
    /**
     * @Route("/", name="blog_image_index", methods={"GET"})
     */
    public function index(BlogImageRepository $blogImageRepository): Response
    {
        return $this->render('blog_image/index.html.twig', [
            'blog_images' => $blogImageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="blog_image_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $blogImage = new BlogImage();
        $form = $this->createForm(BlogImageType::class, $blogImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get("file")->getData();
            if($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL

                $imagename = $originalFilename;
                $newFilename = $imagename.'.'.$imageFile->guessExtension();

                $blogImage->setExtension($imageFile->guessExtension());
                $blogImage->setFileNaam($imagename);
                $path = "uploads/blogImages/" . $originalFilename;
                $blogImage->setFilePath($path .'.' . $imageFile->guessExtension());

                try{
                    $imageFile->move($this->getParameter('blogImages'), $newFilename);
                } catch (FileException $e) {
                    //handle excetion if something happens during file upload
                }


            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogImage);
            $entityManager->flush();

            return $this->redirectToRoute('blog_image_index');
        }

        return $this->render('blog_image/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_image_show", methods={"GET"})
     */
    public function show(BlogImage $blogImage): Response
    {
        return $this->render('blog_image/show.html.twig', [
            'blog_image' => $blogImage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blog_image_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BlogImage $blogImage): Response
    {
        $form = $this->createForm(BlogImageType::class, $blogImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_image_index');
        }

        return $this->render('blog_image/edit.html.twig', [
            'blog_image' => $blogImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_image_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BlogImage $blogImage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogImage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blogImage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog_image_index');
    }
}
