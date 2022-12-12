<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class commandes
{
    /**
     * @Route("/commandes/recapitulatif")
     */
    function recap(){
        return new Response('récapitulatif des commandes');
    }

    /**
     * @Route("/commandes/{joker}")
     */
    function recapJok($joker){
        return new Response(sprintf("liste des commandes '%s'",$joker));
    }


}