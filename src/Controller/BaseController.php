<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    function pagePrincipale()
    {
        return new Response('<a class="favorite styled" type="button" href="http://127.0.0.1:8000/produits/affichage-par-mois">Page produit</a>');
    }

    /**
     * @Route ("/produits/{var}")
     */
    function afficheCreneau($var)
    {
        $commentaires = [
            'Je ne serai pas disponible sur cette période (Gautier)',
            'Je veux bien assurer la relève (Sophie)',
            "Pensez à reporter l'heure manquante (Mélanie)",
        ];
        //return new Response(sprintf("Future page d'affichage de créneau : %s",$var));
        return $this->render('affiche.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $var)),
            'commentaires' => $commentaires,
        ]);
        //ucwords = upper case words
    }
    /**
     * @Route ("/calendrier/{id}")
     */
    function showCalendar()
    {
        $dateYear = date('Y');
        $annee = new \DateTime($dateYear.'-08-31');
        $annee ->modify('first monday');

        $datenextYear= date('Y', strtotime('+1 year'));
        $annee_suivante=new \DateTime($datenextYear.'-08-31');
        $annee_suivante ->modify('first monday');

        $tableau_semaines=[$annee->format('Y-m-d')];
        while ($annee<$annee_suivante)
        {
            $tableau_semaines[]=$annee->modify('next monday')->format('Y-m-d');
        }
        array_pop($tableau_semaines);
        dump($tableau_semaines);
        return $this->render("calendrier.html.twig");
    }

}