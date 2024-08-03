<?php

namespace App\Controller;

use App\Entity\Leraar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\LeraarRepository;
use App\Repository\KlasRepository;
use App\Repository\StudentRepository;

class SchoolController extends AbstractController
{
    #[Route('/school', name: 'app_school')]
    public function index(LeraarRepository $leraarRepository, KlasRepository $klasRepository, StudentRepository $studentRepository): Response
    {
        $klassen = $klasRepository->findAll();
        $leraren = $leraarRepository->findAll();
        $studenten = $studentRepository->findAll();

        return $this->render('index.html.twig', [
            'klassen' => $klassen,
            'leraren' => $leraren,
            'studenten' => $studenten,
        ]);
    }
}
