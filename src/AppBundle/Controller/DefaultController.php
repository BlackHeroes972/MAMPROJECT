<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AssistanteMaternelle;
use AppBundle\Entity\Enfant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * j'écoute cette route dont je suis responsable
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // ici j'apelle les modele
        $em = $this->getDoctrine()->getManager();
        $repoAssistanteMaternelle = $em->getRepository(AssistanteMaternelle::class);
        $repoEnfant = $em->getRepository(Enfant::class);
        $enfants = $repoEnfant->findAll();
        $assistanteMaternelles = $repoAssistanteMaternelle->findAll();

        // je retourne une réponse
        return $this->render('base.html.twig', [
            "enfants" => $enfants,
            "assistanteMaternelles" => $assistanteMaternelles
        ]);
    }

    /**
     * @Route("/a-propos", name="apropos")
     */
    public function aProposAction(Request $request)
    {


        return $this->render('page/a-propos.html.twig', [
        ]);
    }


    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("moncompte/carnetliaison", name="carnetliaison")
     */
    public function CarnetLiaison(Request $request)
    {

        return $this->render('page/carnet-de-liaison.html.twig', [
        ]);
    }
}
