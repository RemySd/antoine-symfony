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

}