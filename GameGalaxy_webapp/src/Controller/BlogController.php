<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog')]
class BlogController extends AbstractController
{
    #[Route('/', name:'app_blog_index', methods:['GET'])]
function index(BlogRepository $blogRepository): Response
    {
    return $this->render('blog/index.html.twig', [
        'blogs' => $blogRepository->findAll(),
    ]);
}

#[Route('/new', name:'app_blog_new', methods:['GET', 'POST'])]
function new (Request $request, BlogRepository $blogRepository): Response {
    $blog = new Blog();
    $form = $this->createForm(BlogType::class, $blog);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $blogRepository->save($blog, true);

        $image = $form->get('image')->getData();

        // On boucle sur les images
        foreach ($image as $image) {
            // On génère un nouveau nom de fichier
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();

            // On copie le fichier dans le dossier uploads
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );

            // On stocke l'image dans la base de données (son nom)
            $blog->setImage($fichier);

            return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog/new.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }
}

#[Route('/{id}', name:'app_blog_show', methods:['GET'])]
function show(Blog $blog): Response
    {
    return $this->render('blog/show.html.twig', [
        'blog' => $blog,
    ]);
}

#[Route('/{id}/edit', name:'app_blog_edit', methods:['GET', 'POST'])]
function edit(Request $request, Blog $blog, BlogRepository $blogRepository): Response
    {
    $form = $this->createForm(BlogType::class, $blog);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $blogRepository->save($blog, true);

        return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('blog/edit.html.twig', [
        'blog' => $blog,
        'form' => $form,
    ]);
}

#[Route('/{id}', name:'app_blog_delete', methods:['POST'])]
function delete(Request $request, Blog $blog, BlogRepository $blogRepository): Response
    {
    if ($this->isCsrfTokenValid('delete' . $blog->getId(), $request->request->get('_token'))) {
        $blogRepository->remove($blog, true);
    }

    return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
}
}
