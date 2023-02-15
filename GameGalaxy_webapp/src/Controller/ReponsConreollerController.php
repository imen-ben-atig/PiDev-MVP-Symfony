<?php

namespace App\Controller;

use App\Entity\Repons;
use App\Form\ReponsType;
use App\Repository\ReponsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/repons/conreoller')]
class ReponsConreollerController extends AbstractController
{
    #[Route('/', name: 'app_repons_conreoller_index', methods: ['GET'])]
    public function index(ReponsRepository $reponsRepository): Response
    {
        return $this->render('repons_conreoller/index.html.twig', [
            'repons' => $reponsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_repons_conreoller_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReponsRepository $reponsRepository): Response
    {
        $repon = new Repons();
        $form = $this->createForm(ReponsType::class, $repon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponsRepository->save($repon, true);

            return $this->redirectToRoute('app_repons_conreoller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('repons_conreoller/new.html.twig', [
            'repon' => $repon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_repons_conreoller_show', methods: ['GET'])]
    public function show(Repons $repon): Response
    {
        return $this->render('repons_conreoller/show.html.twig', [
            'repon' => $repon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_repons_conreoller_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Repons $repon, ReponsRepository $reponsRepository): Response
    {
        $form = $this->createForm(ReponsType::class, $repon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponsRepository->save($repon, true);

            return $this->redirectToRoute('app_repons_conreoller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('repons_conreoller/edit.html.twig', [
            'repon' => $repon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_repons_conreoller_delete', methods: ['POST'])]
    public function delete(Request $request, Repons $repon, ReponsRepository $reponsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$repon->getId(), $request->request->get('_token'))) {
            $reponsRepository->remove($repon, true);
        }

        return $this->redirectToRoute('app_repons_conreoller_index', [], Response::HTTP_SEE_OTHER);
    }
}
