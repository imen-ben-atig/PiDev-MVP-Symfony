<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Form\CommentType;
use App\Entity\Comment;
use App\Repository\BlogRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/blog')]
class BlogController extends AbstractController
{
    #[Route('/', name:'app_blog_index', methods:['GET'])]
function index(BlogRepository $blogRepository): Response
    {
    return $this->render('BACK/blog/index.html.twig', [
        'blogs' => $blogRepository->findAll(),
    ]);
}

#[Route('/addblog', name: 'addblog')]

       public function addblogadmin(Request $request , ManagerRegistry $doctrine): Response
    {
       $blog = new Blog;
       $form = $this->createForm(BlogType::class,$blog);
       $form->handleRequest($request);
       if ($form ->IsSubmitted()&& $form->isValid()){
        $image = $form->get('image')->getData();

        // On boucle sur les images
        foreach($image as $image){
            // On génère un nouveau nom de fichier
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();

            // On copie le fichier dans le dossier uploads
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );

            // On stocke l'image dans la base de données (son nom)
            $blog->setImage($fichier);
        }
        $blog->setCreatedAt(new \DateTime());
        // $date = new DateTime();
        // $currentDate = $date->format('Y-m-d');
        $em=$doctrine->getManager();
       //persist=ajouter
       $em->persist($blog);
       //flush=push
       $em->flush();
       return $this->redirectToRoute('showblog', [
    ]);
       }
       return $this->render('BACK/blog/add.html.twig', [
        'blog' => $form->createView(),
        
    ]);
    }


// #[Route('/{id}', name:'app_blog_show', methods:['GET'])]
// function show(Blog $blog): Response
//     {
//     return $this->render('BACK/blog/show.html.twig', [
//         'blog' => $blog,
//     ]);
// }
#[Route('/showblog', name: 'showblog')]
    public function listBlog(BlogRepository $blogRepository): Response
    {
        $blog=$blogRepository->findAll();
        return $this->render('BACK/blog/show.html.twig', [
            'blog' => $blog,
            
        ]);
    }

    #[Route('/blogdetails/{id}', name: 'blogdetails')]
    public function blogdetail(Request $request, BlogRepository $blogRepository, $id): Response
    {
        $blog = $blogRepository->find($id);
        $comments = new Comment;
        $commentForm = $this->createForm(CommentType::class, $comments);
        $commentForm->handleRequest($request);
    
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comments->setBbid($blog);
            $em = $this->getDoctrine()->getManager();
            //persist=ajouter
            $em->persist($comments);
            //flush=push
            $em->flush();
            return $this->render('FRONT/blogfront/details.html.twig', [
                'blog' => $blog,
                'commentForm' => $commentForm->createView(),
            ]);
            
            if ($commentForm->isSubmitted() && !$commentForm->isValid()) {
                $errors = $this->get('validator')->validate($comments);
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }            
        }
        
    
        return $this->render('FRONT/blogfront/details.html.twig', [
            'blog' => $blog,
            'commentForm' => $commentForm->createView(),
        ]);
    }
    

    // afficher liste des blog front
    #[Route('/showblogfront', name: 'showblogfront')]
    public function listBlogFront(BlogRepository $blogRepository): Response
    {
        $blog=$blogRepository->findAll();
        return $this->render('FRONT/blogfront/show.html.twig', [
            'blog' => $blog,
            
        ]);
    }

    #[Route('/showblogdetail', name: 'showblogdetail')]
    public function listblogdetail(BlogRepository $blogRepository, $id): Response
    {
        $blog=$blogRepository->findBy($id);
        return $this->render('FRONT/blogfront/details.html.twig', [
            'blog' => $blog,
        ]);
    }

    
    #[Route('/updateblog/{id}', name: 'updateblog')]
    public function updateblog(Request $request , ManagerRegistry $doctrine, Blog $blog): Response
    {
       $form = $this->createForm(BlogType::class,$blog);
       $form->handleRequest($request);
       if ($form ->IsSubmitted()){
        $image = $form->get('image')->getData();

        // On boucle sur les images
        foreach($image as $image){
            // On génère un nouveau nom de fichier
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();

            // On copie le fichier dans le dossier uploads
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
        }
            // On stocke l'image dans la base de données (son nom)
            $blog->setImage($fichier);
        $em=$doctrine->getManager();
       //persist=ajouter
       $em->persist($blog);
       //flush=push
       $em->flush();
       return $this->redirectToRoute('showblog', [
    ]);
       }
       return $this->renderForm('BACK/blog/edit.html.twig', [
        'blog' => $form,

    ]);
       
    }


    #[Route('deleteblog/{id}', name: 'deleteblog')]

    public function deleteblog($id , ManagerRegistry $doctrine): Response
   {
    $em=$doctrine->getManager();
    $blog =$doctrine->getRepository(Blog::class);
    $blog =  $blog->find($id);
    $em->remove($blog);
    $em->flush();
    return $this->redirectToRoute('showblog');

   }
}
