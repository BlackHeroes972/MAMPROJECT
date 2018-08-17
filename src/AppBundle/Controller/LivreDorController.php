<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LivreDor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
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
