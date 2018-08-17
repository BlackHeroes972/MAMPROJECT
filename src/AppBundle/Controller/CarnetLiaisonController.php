<?php
/**
 * Created by PhpStorm.
 * User: BlackHeroes972
 * Date: 16/08/2018
 * Time: 19:44
 */

namespace AppBundle\Controller;


use AppBundle\Entity\CarnetLiaison;
use AppBundle\Entity\User;
use AppBundle\Form\CarnetLiaisonType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("carnetliaison")
 */
class CarnetLiaisonController extends Controller
{
    /**
     * Lister les carnets de liaison.
     *
     * @Route("/", name="carnetliaison_index")
     * @Method("GET")
     * @IsGranted("ROLE_USER")
     */
    public function indexAction()
    {
        $carnetliaisons = $this->getDoctrine()->getRepository(CarnetLiaison::class)->findAll();

        return $this->render('@App/admin/carnetliaison/index.html.twig', [
            'carnetliaisons'=>$carnetliaisons,
        ]);
    }

    /**
     * Afficher le détail d'un carnet de liaison.
     *
     * @Route("/show/{id}", name="carnetliaison_show")
     * @Method("GET")
     * @IsGranted("ROLE_USER")
     *
     * @param CarnetLiaison $carnetliaison
     *
     * @return Response
     */
    public function showAction(CarnetLiaison $carnetliaison)
    {
        return $this->render('@App/admin/carnetliaison/show.html.twig', ['carnetliaison'=>carnetliaison]);
    }

    /**
     * Créer/Modifier un carnet de liaison.
     *
     * @Route("/form/{id}", name="carnetliaison_form", defaults={"id" = null})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param null    $id
     *
     * @return RedirectResponse|Response
     */
    public function formAction(Request $request, $id = null)
    {
        if ($id === null) {
            $carnetliaison = new CarnetLiaison();
        }
        else {
            $carnetliaison = $this->getDoctrine()->getRepository(CarnetLiaison::class)->find($id);
            if ($carnetliaison === null){
                return $this->redirectToRoute('carnetliaison_index');
            }
        }

        $form = $this->createForm(CarnetLiaisonType::class, $carnetliaison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($carnetliaison);
            $em->flush();
            return $this->redirectToRoute('carnetliaison_index');
        }

        return $this->render('@App/admin/carnetliaison/form.html.twig', [
            'carnetliaison' => $carnetliaison,
            'form' => $form->createView()
        ]);
    }

    /**
     * Supprimer un carnet de liaison.
     *
     * @Route("/delete/{id}", name="carnetliaison_delete")
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param CarnetLiaison $carnetliaison
     *
     * @return RedirectResponse|Response
     */
    public function deleteAction(Request $request, CarnetLiaison $carnetliaison)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('carnetliaison_delete', ['id' => $carnetliaison->getId(),]))
            ->getForm()
        ;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            if (!$book->getEnfant ()[0]) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($carnetliaison);
                $em->flush();

                $this->addFlash('success','Vous avez supprimé '. $carnetliaison->getTitle() .'.');
            }
            else {
                $this->addFlash('error','Vous ne pouvez pas supprimer un carnet de liaison en cours !');
            }
            return $this->redirectToRoute('carnetliaison_index');
        }

        return $this->render('@App/admin/carnetliaison/delete.html.twig', [
            'carnetliaison' => $carnetliaison,
            'form' => $form->createView()
        ]);
    }

}
