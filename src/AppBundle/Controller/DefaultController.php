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

    // ok quest ce que tu veux faire (coupe les telechargmeent si y en a histoire que ca fluide :)
    // jnai rien en dl
    // oké bin c encore moi et ma connexion de campagnanrd enfin ca marche pas trop mal donc quest ce qut u aimerai faire
    // par exemple qd je cliq  sur accueil .... que la route soit bonne
    // en gros tu donne un name a tes route (ex : carnetLiaison ou homage, ou ce que tu veux)
    // tu peux creer des lien directement sur les routes en twig avec la fonction {{ path('nomDeLaRoute') }}

    /**
     * Pour cette rout je suppose qu'il faut etre connecter pour la voir non ? oui voila
     * donc c'est le systeme de firewall, deja tu peux interdire des routes en entiere qui commence par qqch
     * donc soit tu rajoute admin devant ou, moncompte
     * tu peux rajouter une vérification ici
     * donc voila pour la sécurité tu traite avec le security.yml pour les grosse tranch d'url
     * dans twig et les controller tu as le is_granted() pour faire du conditionnelle
     * d'autre question ? c clair je comprend mieu
     *  un autre truc que tu arrivais pas a faire et dont tu a besoin pour cette aprem ou ?
     * pour linstant ça va je v essayer davancer la
     * oké tu a vu qd je me suis créer un compte il ma envoyer vers une page moche de connexion
     * voilou si t'as pas d'autre question je t'abandonne a ton triste sort je serai co en fin d'aprem si jamais
     * ok merci encore pas de pb a plus tard
     * et oublie pas de push de temps en temps histoire que j'ai ton compte a jouroki
     * tu peux comparer les origine et push avec phpstorm allé aplucheokiiiiiii mrc
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("moncompte/carnetliaison", name="carnetliaison")
     */
    public function CarnetLiaison(Request $request)
    {

        return $this->render('page/carnet-de-liaison.html.twig', [
        ]);
    }
}
