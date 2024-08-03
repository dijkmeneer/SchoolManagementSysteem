<?php

namespace App\Controller;

use App\Entity\Leraar;
use App\Form\LeraarType;
use App\Repository\LeraarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/leraar')]
class LeraarController extends AbstractController
{
    #[Route('/', name: 'app_leraar_index', methods: ['GET'])]
    public function index(LeraarRepository $leraarRepository): Response
    {
        return $this->render('leraar/index.html.twig', [
            'leraars' => $leraarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_leraar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $leraar = new Leraar();
        $form = $this->createForm(LeraarType::class, $leraar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($leraar);
            $entityManager->flush();

            return $this->redirectToRoute('app_leraar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('leraar/new.html.twig', [
            'leraar' => $leraar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_leraar_show', methods: ['GET'])]
    public function show(Leraar $leraar): Response
    {
        return $this->render('leraar/show.html.twig', [
            'leraar' => $leraar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_leraar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Leraar $leraar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LeraarType::class, $leraar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_leraar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('leraar/edit.html.twig', [
            'leraar' => $leraar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_leraar_delete', methods: ['POST'])]
    public function delete(Request $request, Leraar $leraar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leraar->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($leraar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_leraar_index', [], Response::HTTP_SEE_OTHER);
    }
}
