<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Calendrier;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class CalendrierController extends AbstractController
{
    /**
     * @Route("/calendrier/create")
     */
    public function create(EntityManagerInterface $entityManager)
    {
        // Créez un nouvel objet Calendrier
        $calendrier = new Calendrier();
        $calendrier->setLibellePeriode('Trimestre 1');
        $calendrier->setDateDebut(new \DateTime('2022-09-01'));
        $calendrier->setDateFin(new \DateTime('2022-12-31'));

        // Enregistrez l'objet Calendrier en base de données
        $entityManager->persist($calendrier);
        $entityManager->flush();

        return new Response('Calendrier créé avec l\'ID ' . $calendrier->getIdCalendrier());
    }

    /**
     * @Route("/calendrier/{id}", requirements={"id"="\d+"})
     */
    public function read($id)
    {
        // Récupérez l'objet Calendrier en base de données à l'aide de l'ID
        $calendrier = $this->getDoctrine()
            ->getRepository(Calendrier::class)
            ->find($id);

        if (!$calendrier) {
            throw $this->createNotFoundException(
                'Aucun calendrier trouvé avec l\'ID ' . $id
            );
        }

        return new Response('Calendrier trouvé : ' . $calendrier->getLibellePeriode() . ' du ' . $calendrier->getDateDebut()->format('d/m/Y') . ' au ' . $calendrier->getDateFin()->format('d/m/Y'));
    }

    /**
     * @Route("/calendrier/update/{id}", requirements={"id"="\d+"})
     */
    public function update($id, EntityManagerInterface $entityManager)
    {
        // Récupérez l'objet Calendrier en base de données à l'aide de l'ID
        $calendrier = $this->getDoctrine()
            ->getRepository(Calendrier::class)
            ->find($id);

        if (!$calendrier) {
            throw $this->createNotFoundException(
                'Aucun calendrier trouvé avec l\'ID ' . $id
            );
        }
        // Modifiez les données de l'objet Calendrier
        $calendrier->setLibellePeriode('Trimestre 2');
        $calendrier->setDateDebut(new \DateTime('2022-01-01'));
        $calendrier->setDateFin(new \DateTime('2022-03-31'));

        // Enregistrez les modifications en base de données
        $entityManager->flush();

        return new Response('Calendrier mis à jour avec l\'ID ' . $calendrier->getIdCalendrier());
    }

    /**
     * @Route("/calendrier/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete($id, EntityManagerInterface $entityManager)
    {
        // Récupérez l'objet Calendrier en base de données à l'aide de l'ID
        $calendrier = $this->getDoctrine()
            ->getRepository(Calendrier::class)
            ->find($id);

        if (!$calendrier) {
            throw $this->createNotFoundException(
                'Aucun calendrier trouvé avec l\'ID '.$id
            );
        }

        // Supprimez l'objet Calendrier de la base de données
        $entityManager->remove($calendrier);
        $entityManager->flush();

        return new Response('Calendrier supprimé avec l\'ID '.$id);
    }
}