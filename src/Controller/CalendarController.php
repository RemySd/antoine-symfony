<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendarController extends AbstractController
{
    #[Route('/get-alternance-weeks', name: 'get_alternances', methods: ['GET'])]
    public function getAlternance(CalendrierRepository $calendrierRepository): JsonResponse
    {
        $weeks = $calendrierRepository->findBy(['type' => 'alternance']);

        return $this->json($weeks);
    }
}
