<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Matiere;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class MatiereController extends AbstractController
{
    /**
     * @Route("/matiere/create")
     */
    public function create(EntityManagerInterface $entityManager)
    {
        // Créez un nouvel objet Matière
        $matiere = new Matiere();
        $matiere->setLibelleMatiere('Mathématiques');
        $matiere->setSpecialite('Informatique');

        // Enregistrez l'objet Matière en base de données
        $entityManager->persist($matiere);
        $entityManager->flush();

        return new Response('Matière créée avec l\'ID ' . $matiere->getIdMatiere());
    }

    /**
     * @Route("/matiere/{id}", requirements={"id"="\d+"})
     */
    public function read($id)
    {
        // Récupérez l'objet Matière en base de données à l'aide de l'ID
        $matiere = $this->getDoctrine()
            ->getRepository(Matiere::class)
            ->find($id);

        if (!$matiere) {
            throw $this->createNotFoundException(
                'Aucune matière trouvée avec l\'ID ' . $id
            );
        }

        return new Response('Matière trouvée : ' . $matiere->getLibelleMatiere() . ' (spécialité ' . $matiere->getSpecialite() . ')');
    }

    /**
     * @Route("/matiere/update/{id}", requirements={"id"="\d+"})
     */
    public function update($id, EntityManagerInterface $entityManager)
    {
        // Récupérez l'objet Matière en base de données à l'aide de l'ID
        $matiere = $this->getDoctrine()
            ->getRepository(Matiere::class)
            ->find($id);

        if (!$matiere) {
            throw $this->createNotFoundException(
                'Aucune matière trouvée avec l\'ID '.$id
            );
        }

        // Modifiez les données de l'objet Matière
        $matiere->setLibelleMatiere('Physique');
        $matiere->setSpecialite('Chimie');

        // Enregistrez les modifications en base de données
        $entityManager->flush();

        return new Response('Matière mise à jour avec l\'ID '.$matiere->getIdMatiere());
    }

    /**
     * @Route("/matiere/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete($id, EntityManagerInterface $entityManager)
    {
        // Récupérez l'objet Matière en base de données à l'aide de l'ID
        $matiere = $this->getDoctrine()
            ->getRepository(Matiere::class)
            ->find($id);

        if (!$matiere) {
            throw $this->createNotFoundException(
                'Aucune matière trouvée avec l\'ID '.$id
            );
        }

        // Supprimez l'objet Matière de la base de données
        $entityManager->remove($matiere);
        $entityManager->flush();

        return new Response('Matière supprimée avec l\'ID '.$id);
    }
}




