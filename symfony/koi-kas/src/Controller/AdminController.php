<?php


namespace App\Controller;



use App\Entity\Categorie;
use App\Entity\Image;
use App\Entity\Karper;
use App\Entity\Kweker;
use App\Entity\Leeftijd;
use App\Entity\Maat;
use App\Entity\Product;
use App\Entity\Soort;
use App\Entity\User;
use App\Form\Type\ImageType;
use App\Form\Type\ProductType;
use App\Form\UserType;
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
 * @Route("/admin")
 */
class AdminController extends AbstractController
{

    /**
     * @Route("/home", name="admin_home")
     * @IsGranted("ROLE_ADMIN")
     */
    public function home() {
        return $this->render('admin/home.html.twig');
    }


    /**
     * @Route("/user/overzicht", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/new")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
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

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/show/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/edit/{id}", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
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
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("/image/new", name="new_image")
     */
    public function newImage(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $image = new Image();

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image_file_name')->getData();
            if($imageFile) {
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
        return $this->render('admin/foto.html.twig', [ "form" => $form->createView()]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test() {


        return $this->render('admin/test.html.twig');
    }

    /**
     * @Route("/uploadFile", name="uploadFile")
     */

    public function uploadFile(Request $request, LoggerInterface $logger): Response {
        $image = $_FILES['image'];

        $target = $this->getParameter('blogImages').'/'.$image['name'];;
        move_uploaded_file( $image['tmp_name'], $target );
        $path = '../uploads/blogImages/'.$image['name'];
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
     * @Route("/producten", name="admin_producten")
     */
    public function adminProducten() {
        $em = $this->getDoctrine()->getManager();
        $producten = $em->getRepository(Product::class)->findAll();
        return $this->render("admin/producten.html.twig", [
            'producten' => $producten
        ]);
    }

    /**
     * @Route("/producten/toevoegen", name="product_toevoegen")
     */
    public function add_product(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if($image) {
                $uri = $product->setUri($image);

                $product->setImage($uri->getUri());
            }
            $product = $form->getData();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('admin_producten');
        }

        return $this->render('admin/producten_toevoegen.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/producten/wijzigen/{id}", name="product_wijzigen")
     */

    public function product_wijzigen(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Product::class)->find($id);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product=$form->getData();

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            return $this->redirectToRoute('admin_producten');
        }

        return $this->render('admin/product_wijzigen.html.twig', [
            'form' => $form->createView(),
            'product' => $product
        ]);

    }

    /**
     * @Route("/producten/{id}", name="admin_product")
     */

    public function product($id) {
        $em = $this->getDoctrine()->getManager();
        $producten = $em->getRepository(Product::class)->findBy([
            'id' => $id
        ]);

        $producten = $producten[0];
        return $this->render('admin/product.html.twig', [
            'product' => $producten
        ]);
    }

    /**
     * @Route("/filter", name="filterTest")
     */
    public function filterTest(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $kwekers = $em->getRepository(Kweker::class)->findAll();
        $soorten = $em->getRepository(Soort::class)->findAll();
        $leeftijden = $em->getRepository(Leeftijd::class)->findAll();
        $maten = $em->getRepository(Maat::class)->findAll();
        $t = $em->getRepository(Karper::class)->findBy([
            'soort' => 1
        ]);
        $qb = $em->getRepository(Karper::class)->createQueryBuilder('kp');
        if($request->query->getAlnum('soort')) {
            $qb->join('kp.soort', 'soort')
                ->where('soort.zoekNaam LIKE :soort')->setParameter(':soort', $request->query->getAlnum('soort'));
        }
        if($request->query->getAlnum('kweker')) {
            $qb->join('kp.kweker', 'k')
                ->andWhere('k.zoekNaam LIKE :kweker')->setParameter(':kweker', $request->query->getAlnum('kweker'));
        }

        if($request->query->getAlnum('maat')) {
            $qb->join('kp.maat', 'm')
                ->andWhere('m.zoekNaam LIKE :maat')->setParameter(':maat', $request->query->getAlnum('maat'));
        }
        if($request->query->getAlnum('leeftijd')) {
            $qb->join('kp.leeftijd', 'l')
                ->andWhere('l.zoekNaam LIKE :leeftijd')->setParameter(':leeftijd', $request->query->getAlnum('leeftijd'));
        }

        $p = $em->getRepository(Karper::class)->findBy([
            'soort' => 1
        ]);
        //dd($p);
        $query = $qb->getQuery();
        //dd($qb);
        $producten = $query->getArrayResult();
        //dd($producten);
        //dd($query);
        //dd($test);

       // $producten = $em->getRepository(Karper::class)->findAll();
        //dd($producten);
        return $this->render('admin/filter_test.html.twig', [
            'producten' => $producten,
            'kwekers' => $kwekers,
            'soorten' => $soorten,
            'leeftijden' => $leeftijden,
            'maten' => $maten,
            't' => $t
        ]);
    }

}