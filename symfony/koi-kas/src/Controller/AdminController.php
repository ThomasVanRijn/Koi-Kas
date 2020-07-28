<?php


namespace App\Controller;


use App\Entity\Categorie;
use App\Entity\Image;
use App\Entity\Karper;
use App\Entity\Kweker;
use App\Entity\Product;
use App\Entity\Soort;
use App\Entity\User;
use App\Form\KarperType;
use App\Form\KwekerType;
use App\Form\SoortType;
use App\Form\Type\ImageType;
use App\Form\Type\ProductType;
use App\Form\UserType;
use App\Repository\KarperRepository;
use App\Repository\SoortRepository;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
//+
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render('admin/home.html.twig');
    }


    //USER CRUD

    /**
     * @Route("/user/overzicht", name="user_index", methods={"GET"})
     */
    public function userIndex(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/new", name="user_new")
     */
    public function userNew(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $person = $form->getData();
            $em->persist($person);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('admin/user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/show/{id}", name="user_show", methods={"GET"})
     */
    public function userShow(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/edit/{id}", name="user_edit", methods={"GET","POST"})
     */
    public function userEdit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/delete/{id}", name="user_delete", methods={"DELETE"})
     */
    public function userDelete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }


    //PRODUCT CRUD

    /**
     * @Route("/producten/overzicht", name="product_index")
     */
    public function productIndex()
    {
        $em = $this->getDoctrine()->getManager();
        $producten = $em->getRepository(Product::class)->findAll();
        return $this->render("admin/product/index.html.twig", [
            'producten' => $producten
        ]);
    }

    /**
     * @Route("/producten/toevoegen", name="product_new")
     */
    public function productNew(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $uri = $product->setUri($image);

                $product->setImage($uri->getUri());
            }
            $product = $form->getData();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('admin/product/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/producten/{id}", name="product_show")
     */
    public function productShow($id)
    {
        $em = $this->getDoctrine()->getManager();
        $producten = $em->getRepository(Product::class)->findBy([
            'id' => $id
        ]);

        $producten = $producten[0];
        return $this->render('admin/product/show.html.twig', [
            'product' => $producten
        ]);
    }

    /**
     * @Route("/producten/{id}/bewerken", name="product_edit", methods={"GET","POST"})
     */
    public function productEdit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("producten/delete/{id}", name="product_delete", methods={"DELETE"})
     */
    public function productDelete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_product_index');
    }


    /**
     * @Route("/karpersbeheren", name="karper_index", methods={"GET"})
     */
    public function karpersBewerken(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $karpers = $em->getRepository(Karper::class)->findAll();
        $soorten = $em->getRepository(Soort::class)->findAll();
        $kwekers = $em->getRepository(Kweker::class)->findAll();

        return $this->render('admin/karpers_beheren.html.twig', [
            'karpers' => $karpers,
            'soorten' => $soorten,
            'kwekers' => $kwekers,
        ]);
    }


    // KARPERS CRUD

    /**
     * @Route("/karpers/toevoegen", name="karper_new", methods={"GET","POST"})
     */
    public function karpersNew(Request $request): Response
    {
        $karper = new Karper();
        $form = $this->createForm(KarperType::class, $karper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($karper);
            $entityManager->flush();

            return $this->redirectToRoute('admin_karper_index');
        }

        return $this->render('admin/karper/new.html.twig', [
            'karper' => $karper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/karpers/{id}", name="karper_show", methods={"GET"})
     */
    public function karpersShow(Karper $karper): Response
    {
        return $this->render('admin/karper/show.html.twig', [
            'karper' => $karper,
        ]);
    }

    /**
     * @Route("/karpers/{id}/bewerken", name="karper_edit", methods={"GET","POST"})
     */
    public function karpersEdit(Request $request, Karper $karper): Response
    {
        $form = $this->createForm(KarperType::class, $karper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_karper_index');
        }

        return $this->render('admin/karper/edit.html.twig', [
            'karper' => $karper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/karpers/{id}", name="karper_delete", methods={"DELETE"})
     */
    public function karpersDelete(Request $request, Karper $karper): Response
    {
        if ($this->isCsrfTokenValid('delete'.$karper->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($karper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_karper_index');
    }


    // SOORTEN CRUD

    /**
     * @Route("/soorten/toevoegen", name="soort_new", methods={"GET","POST"})
     */
    public function soortenNew(Request $request): Response
    {
        $soort = new Soort();
        $form = $this->createForm(SoortType::class, $soort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($soort);
            $entityManager->flush();

            return $this->redirectToRoute('admin_karper_index');
        }

        return $this->render('admin/soort/new.html.twig', [
            'soort' => $soort,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/soorten/{id}", name="soort_show", methods={"GET"})
     */
    public function soortenShow(Soort $soort): Response
    {
        return $this->render('admin/soort/show.html.twig', [
            'soort' => $soort,
        ]);
    }

    /**
     * @Route("/soorten/{id}/bewerken", name="soort_edit", methods={"GET","POST"})
     */
    public function soortenEdit(Request $request, Soort $soort): Response
    {
        $form = $this->createForm(SoortType::class, $soort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_karper_index');
        }

        return $this->render('admin/soort/edit.html.twig', [
            'soort' => $soort,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/soorten/{id}", name="soort_delete", methods={"DELETE"})
     */
    public function soortenDelete(Request $request, Soort $soort): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soort->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soort);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_karper_index');
    }


    // KWEKERS CRUD

    /**
     * @Route("/kwekers/toevoegen", name="kweker_new", methods={"GET","POST"})
     */
    public function kwekersNew(Request $request): Response
    {
        $kweker = new Kweker();
        $form = $this->createForm(KwekerType::class, $kweker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kweker);
            $entityManager->flush();

            return $this->redirectToRoute('admin_karper_index');
        }

        return $this->render('admin/kweker/new.html.twig', [
            'kweker' => $kweker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/kwekers/{id}", name="kweker_show", methods={"GET"})
     */
    public function kwekersShow(Kweker $kweker): Response
    {
        return $this->render('admin/kweker/show.html.twig', [
            'kweker' => $kweker,
        ]);
    }

    /**
     * @Route("/kwekers/{id}/bewerken", name="kweker_edit", methods={"GET","POST"})
     */
    public function kwekerEdit(Request $request, Kweker $kweker): Response
    {
        $form = $this->createForm(KwekerType::class, $kweker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_karper_index');
        }

        return $this->render('admin/kweker/edit.html.twig', [
            'kweker' => $kweker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/kwekers/{id}", name="kweker_delete", methods={"DELETE"})
     */
    public function kwekerDelete(Request $request, Kweker $kweker): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kweker->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kweker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_karper_index');
    }


    //OVERIGE

    /**
     * @Route("/image/new", name="new_image")
     */
    public function newImage(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $image = new Image();

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image_file_name')->getData();
            if ($imageFile) {
                $uri = $image->setUri($imageFile);
            }
            $image = $form->getData();
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $img = $em->getRepository(Image::class)->find(1);
        $img->setString($img->getBreedte(), $img->getHoogte(), $img->getUri());
        //dd($img->getString());
        return $this->render('admin/foto.html.twig', ["form" => $form->createView()]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {


        return $this->render('admin/test.html.twig');
    }

    /**
     * @Route("/uploadFile", name="uploadFile")
     */
    public function uploadFile(Request $request, LoggerInterface $logger): Response
    {
        $image = $_FILES['image'];

        $target = $this->getParameter('blogImages') . '/' . $image['name'];;
        move_uploaded_file($image['tmp_name'], $target);
        $path = '../uploads/blogImages/' . $image['name'];
        $response = new Response();
        $json = ['success' => 1, 'file' => ['url' => $path], 'fileName' => $image];
        $response->setContent(json_encode($json));
        $response->setStatusCode(Response::HTTP_OK);

// sets a HTTP response header
        $response->headers->set('Content-Type', 'application/json');

// prints the HTTP headers followed by the content
        return $response;
    }

    /**
     * @Route("/filter", name="filterTest")
     */
    public function filterTest(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $kwekers = $em->getRepository(Kweker::class)->findAll();
        $soorten = $em->getRepository(soort::class)->findAll();
        $leeftijden = $em->getRepository(Leeftijd::class)->findAll();
        $maten = $em->getRepository(Maat::class)->findAll();
        $t = $em->getRepository(Karper::class)->findBy([
            'soort' => 1
        ]);
        $qb = $em->getRepository(Karper::class)->createQueryBuilder('kp');
        if ($request->query->getAlnum('soort')) {
            $qb->join('kp.soort', 'soort')
                ->where('soort.zoekNaam LIKE :soort')->setParameter(':soort', $request->query->getAlnum('soort'));
        }
        if ($request->query->getAlnum('kweker')) {
            $qb->join('kp.kweker', 'k')
                ->andWhere('k.zoekNaam LIKE :kweker')->setParameter(':kweker', $request->query->getAlnum('kweker'));
        }

        if ($request->query->getAlnum('maat')) {
            $qb->join('kp.maat', 'm')
                ->andWhere('m.zoekNaam LIKE :maat')->setParameter(':maat', $request->query->getAlnum('maat'));
        }
        if ($request->query->getAlnum('leeftijd')) {
            $qb->join('kp.leeftijd', 'l')
                ->andWhere('l.zoekNaam LIKE :leeftijd')->setParameter(':leeftijd', $request->query->getAlnum('leeftijd'));
        }

        $query = $qb->getQuery();

        $producten = $query->getArrayResult();

        return $this->render('admin/filter_test.html.twig', [
            'producten' => $producten,
            'kwekers' => $kwekers,
            'soorten' => $soorten,
            'leeftijden' => $leeftijden,
            'maten' => $maten
        ]);
    }

    /**
     * @Route("/soort/toevoegen", name="soortToevoegen")
     */
    public function soortToevoegen(Request $request)
    {
        $soort = new soort();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SoortType::class, $soort);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $soort = $form->getData();

            $em->persist($soort);
            $em->flush();
            return $this->redirectToRoute('karpersBeheren');
        }
        return $this->render('admin/soort_toevoegen.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/karper/toevoegen", name="karperToevoegen")
     */
    public function karperToevoegen(Request $request)
    {
        $karper = new Karper();

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(KarperType::class, $karper);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $karper = $form->getData();
            $em->persist($karper);
            $em->flush();
            return $this->redirectToRoute('karpersBeheren');
        }

        return $this->render('admin/karper_toevoegen.html.twig', [
            'form' => $form->createView()
        ]);

    }

//    /**
//     * @Route("/koi-karper/{id}", name="karper_detail", methods={"GET","POST"})
//     */
//    public function karperDetail(Karper $Karper): Response
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        return $this->render('admin/karper-detail.html.twig', [
//            'karper' => $Karper,
//        ]);
//    }

}