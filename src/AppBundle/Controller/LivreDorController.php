<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LivreDor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * tu peux créer des controller pour isoler des partie de l'outil et t'en servir pour les prefixé
 * c'est plus pratique ensuite pour t'y retrouver dans ton code qu'un seul controller de 5000 lignes
 * voila d'autre question ou tu veux voir un exemple de comment je créerai le livre d'or et je connecterai le modèle ? oui tp
 * @Route("/livre-d-or")
 */
class LivreDorController extends Controller
{
    /**
     * @Route("/liste", name="listeLivreDor")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $LivreOrRepo = $em->getRepository(LivreDor::class);
        $messages = $LivreOrRepo->findAll();

        return $this->render('livredor/liste.html.twig', [
            "messages" => $messages
        ]);
    }

    /**
     * @Route("/ajouter-message", name="ajoutMessage")
     */
    public function addMessageAction()
    {
        // ici il va falloir creer un formulaire
        return $this->render('', []);
    }

    /**
     * @Route("/supprimer-message/{id}", name="deleteMessage")
     */
    public function deleteMessageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $LivreOrRepo = $em->getRepository(LivreDor::class);

        $message = $LivreOrRepo->find($id);
        $em->remove($message);
        $em->flush();

        // quand j'ai finis de supprimer je retourner sur la liste ca me parait logique
        return $this->redirectToRoute('listeLivreDor');
    }
}
