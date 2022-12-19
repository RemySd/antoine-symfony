<?php

namespace App\Controller;

use App\Entity\Intervenant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IntervenantController extends AbstractController
{
    /**
     * @Route("/intervenant/create", name="intervenant_create")
     */
    public function create(Request $request)
    {
        $intervenant = new Intervenant();
        $intervenant->setIdUtilisateur($request->request->get('id_utilisateur'));
        $intervenant->setIdRole($request->request->get('id_role'));
        $intervenant->setIdMatiere($request->request->get('id_matiere'));
        $intervenant->setNbHeure($request->request->get('nb_heure'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($intervenant);
        $entityManager->flush();

        return new Response('Intervenant créé avec l\'ID '.$intervenant->getIdIntervenant());
    }

    /**
     * @Route("/intervenant/read", name="intervenant_read")
     */
    public function read()
    {
        $intervenants = $this->getDoctrine()->getRepository(Intervenant::class)->findAll();

        return $this->render('intervenant/read.html.twig', array('intervenants' => $intervenants));
    }

    /**
     * @Route("/intervenant/update/{id}", name="intervenant_update")
     */
    public function update(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $intervenant = $entityManager->getRepository(Intervenant::class)->find($id);

        if (!$intervenant) {
            throw $this->createNotFoundException(
                'Aucun intervenant trouvé avec l\'ID ' . $id
            );
        }

        $intervenant->setIdUtilisateur($request->request->get('id_utilisateur'));
        $intervenant->setIdRole($request->request->get('id_role'));
        $intervenant->setIdMatiere($request->request->get('id_matiere'));
        $intervenant->setNbHeure($request->request->get('nb_heure'));

        $entityManager->flush();

        return $this->redirectToRoute('intervenant_read');
    }

    /**
     * @Route("/intervenant/delete/{id}", name="intervenant_delete")
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $intervenant = $entityManager->getRepository(Intervenant::class)->find($id);

        if (!$intervenant) {
            throw $this->createNotFoundException(
                'Aucun intervenant trouvé avec l\'ID '.$id
            );
        }

        $entityManager->remove($intervenant);
        $entityManager->flush();

        return $this->redirectToRoute('intervenant_read');
    }

}



