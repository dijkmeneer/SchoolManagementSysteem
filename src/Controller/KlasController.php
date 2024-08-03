<?php

namespace App\Controller;

use App\Entity\Klas;
use App\Form\KlasType;
use App\Repository\KlasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/klas')]
class KlasController extends AbstractController
{
    #[Route('/', name: 'app_klas_index', methods: ['GET'])]
    public function index(KlasRepository $klasRepository): Response
    {
        return $this->render('klas/index.html.twig', [
            'klas' => $klasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_klas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $klas = new Klas();
        $form = $this->createForm(KlasType::class, $klas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($klas);
            $entityManager->flush();

            return $this->redirectToRoute('app_klas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('klas/new.html.twig', [
            'klas' => $klas,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_klas_show', methods: ['GET'])]
    public function show(Klas $klas): Response
    {
        $studenten = $klas->getStudents();
        $leraren = $klas->getLeraar();

        return $this->render('klas/show.html.twig', [
            'klas' => $klas,
            'studenten' => $studenten,
            'leraren' => $leraren,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_klas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Klas $klas, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(KlasType::class, $klas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_klas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('klas/edit.html.twig', [
            'klas' => $klas,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_klas_delete', methods: ['POST'])]
    public function delete(Request $request, Klas $klas, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$klas->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($klas);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_klas_index', [], Response::HTTP_SEE_OTHER);
    }
}
