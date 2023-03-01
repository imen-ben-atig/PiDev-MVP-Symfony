<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchType;

#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    #[Route('/', name: 'app_front_reclamation_index', methods: ['GET'])]
    public function indexFront(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index_front.html.twig', [
            'reclamation' => $reclamationRepository->findAll(),
        ]);
    }

    #[Route('/rec', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReclamationRepository $reclamationRepository): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);
            $reclamationRepository->sms();
            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    #[Route('/his', name: 'app_reclamation_show1', methods: ['GET'])]
    public function show1(Reclamation $reclamation): Response
    {
        
        return $this->render('reclamation/historique.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $reclamationRepository->remove($reclamation, true);
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        
    }
    // #[Route('/TriAsc', name: 'reclamationTriCroi')]
    // public function triStatutCroissant(Request $request, PaginatorInterface $paginator)
    // {
    //     $donnees = $this->getDoctrine()->getRepository(Reclamation::class)->findBy(['active' => 'true'], array('statut_rec' => 'ASC'));
    //     $produits = $paginator->paginate(
    //         $donnees,
    //         $request->query->getInt('page', 1),
    //         4
    //     );
    //     return $this->render('reclamation/index.html.twig', ['r' => $reclamations]);
    // }
    #[Route('search', name: 'reclamation_search')]

    public function search(ReclamationRepository $reclamationRepository, Request $request): Response
    {
        $issetTitre = isset($_GET['titre']);
        if ($issetTitre) {
            
            $reclamations = $reclamationRepository->searchReclamations($_GET['titre']);
    
            return $this->render('reclamation/index.html.twig', [
                'reclamations' => $reclamations,
            ]);
        }
    
        return $this->render('reclamation/search.html.twig', [
            'reclamationsearch' => $form->createView(),
        ]);
    }
    
        //     //sms
        // #[Route('/admin/traiter/{id}', name: 'reclamationtraite')]
        //     function Traiter(ReclamationsRepository $repository, $id, Request $request, ManagerRegistry $doctrine, UserRepository $repo)
        //     {
        //         $user = new User();
        //         $user->eraseCredentials();
        //         $reclamation = new Reclamations();
        //         $user = $repo->find($id);
        //         $em = $doctrine->getManager();
        //         $em->flush();
        //         $repository->sms();
        //         $reclamation->setEtat("yes");
        //         $em->flush();
        //         $this->addFlash('danger', 'reponse envoyée avec succées');
        //         return $this->redirectToRoute('app_reclamations_index');
        //     }
}
