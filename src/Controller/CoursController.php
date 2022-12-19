<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class CoursController extends AbstractController
{
    /**
     * @Route("/cours/create")
     */
    public function create(EntityManagerInterface $entityManager)
    {
        // Créez un nouvel objet Cours
        $cours = new Cours();
        $cours->setIdCalendrier(1);
        $cours->setIdMatiere(1);
        $cours->setIdIntervenant(1);
        $cours->setDateHeureCourDebut(new \DateTime('2022-09-01 09:00:00'));
        $cours->setDateHeureCourFin(new \DateTime('2022-09-01 10:30:00'));

        // Enregistrez l'objet Cours en base de données
        $entityManager->persist($cours);
        $entityManager->flush();

        return new Response('Cours créé avec l\'ID ' . $cours->getIdCours());
    }

    /**
     * @Route("/cours/{id}", requirements={"id"="\d+"})
     */
    public function read($id)
    {
        // Récupérez l'objet Cours en base de données à l'aide de l'ID
        $cours = $this->getDoctrine()
            ->getRepository(Cours::class)
            ->find($id);

        if (!$cours) {
            throw $this->createNotFoundException(
                'Aucun cours trouvé avec l\'ID ' . $id
            );
        }

        return new Response('Cours trouvé : ' . $cours->getIdMatiere() . ' donné par ' . $cours->getIdIntervenant() . ' le ' . $cours->getDateHeureCourDebut()->format('d/m/Y à H:i') . ' au ' . $cours->getDateHeureCourFin()->format('H:i'));
    }

    /**
     * @Route("/cours/update/{id}", requirements={"id"="\d+"})
     */
    public function update($id, EntityManagerInterface $entityManager)
    {
        // Récupérez l'objet Cours en base de données à l'aide de l'ID
        $cours = $this->getDoctrine()
            ->getRepository(Cours::class)
            ->find($id);

        if (!$cours) {
            throw $this->createNotFoundException(
                'Aucun cours trouvé avec l\'ID '.$id
            );
        }

        // Modifiez les données de l'objet Cours
        $cours->setIdMatiere(2);
        $cours->setIdIntervenant(2);
        $cours->setDateHeureCourDebut(new \DateTime('2022-09-02 09:00:00'));
        $cours->setDateHeureCourFin(new \DateTime('2022-09-02 10:30:00'));

        // Enregistrez les modifications en base de données
        $entityManager->flush();

        return new Response('Cours mis à jour avec l\'ID '.$cours->getIdCours());
    }

    /**
     * @Route("/cours/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete($id, EntityManagerInterface $entityManager)
    {
        // Récupérez l'objet Cours en base de données à l'aide de l'ID
        $cours = $this->getDoctrine()
            ->getRepository(Cours::class)
            ->find($id);

        if (!$cours) {
            throw $this->createNotFoundException(
                'Aucun cours trouvé avec l\'ID '.$id
            );
        }

        // Supprimez l'objet Cours de la base de données
        $entityManager->remove($cours);
        $entityManager->flush();

        return new Response('Cours supprimé avec l\'ID '.$id);
    }
}