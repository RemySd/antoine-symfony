<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\MatiereRepository;
use App\Repository\CalendrierRepository;
use App\Repository\CoursRepository;
use App\Repository\IntervenantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    #[Route('/get-cours-infos', name: 'get_cours_infos', methods: ['GET'])]
    public function getAddCoursTemplate(IntervenantRepository $intervenantRepository, MatiereRepository $matiereRepository): Response
    {
        $intervenants = $intervenantRepository->findAll();
        $matieres = $matiereRepository->findAll();

        return $this->render('template_cours_admin.html.twig', [
            'intervenants' => $intervenants,
            'matieres' => $matieres
        ]);
    }

    #[Route('/get-cours', name: 'get_cours', methods: ['GET'])]
    public function getCours(CoursRepository $coursRepository): JsonResponse
    {
        $cours = $coursRepository->findAll();

        return $this->json($cours);
    }

    #[Route('/add-cours', name: 'add_cours', methods: ['POST'])]
    public function addCours(Request $request, CoursRepository $coursRepository): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);

        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid()) {
            $coursRepository->save($cours, true);

            return $this->json(["status" => "ok"]);
        }

        return $this->json(["status" => "error"]);
    }
}
