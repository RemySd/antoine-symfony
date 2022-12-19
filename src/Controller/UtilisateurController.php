<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur/create")
     */
    public function create(EntityManagerInterface $entityManager)
    {
        // Créez un nouvel objet Utilisateur
        $utilisateur = new Utilisateur();
        $utilisateur->setNom('John');
        $utilisateur->setPrenom('Doe');
        $utilisateur->setIdRole(1);

        // Enregistrez l'objet Utilisateur en base de données
        $entityManager->persist($utilisateur);
        $entityManager->flush();

        return new Response('Utilisateur créé avec l\'ID ' . $utilisateur->getIdUtilisateur());
    }

    /**
     * @Route("/utilisateur/{id}", requirements={"id"="\d+"})
     */
    public function read($id)
    {
        // Récupérez l'objet Utilisateur en base de données à l'aide de l'ID
        $utilisateur = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->find($id);

        if (!$utilisateur) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé avec l\'ID ' . $id
            );
        }

        return new Response('Utilisateur trouvé : ' . $utilisateur->getNom() . ' ' . $utilisateur->getPrenom());
    }

    /**
     * @Route("/utilisateur/update/{id}", requirements={"id"="\d+"})
     */
    public function update($id, EntityManagerInterface $entityManager)
    {
        // Récupérez l'objet Utilisateur en base de données à l'aide de l'ID
        $utilisateur = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->find($id);

        if (!$utilisateur) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé avec l\'ID ' . $id
            );
        }

        // Modifiez les données de l'objet Utilisateur
        $utilisateur->setNom('Jane');
        $utilisateur->setPrenom('Doe');
        $utilisateur->setIdRole(2);

        // Enregistrez les modifications en base de données
        $entityManager->flush();

        return new Response('Utilisateur mis à jour avec l\'ID ' . $utilisateur->getIdUtilisateur());
    }

    /**
     * @Route("/utilisateur/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete($id, EntityManagerInterface $entityManager)
    {
        // Récupérez l'objet Utilisateur en base de données à l'aide de l'ID
        $utilisateur = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->find($id);

        if (!$utilisateur) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé avec l\'ID '.$id
            );
        }

        // Supprimez l'objet Utilisateur de la base de données
        $entityManager->remove($utilisateur);
        $entityManager->flush();

        return new Response('Utilisateur supprimé avec l\'ID '.$id);
    }
}