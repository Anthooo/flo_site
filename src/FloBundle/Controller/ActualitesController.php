<?php

namespace FloBundle\Controller;

use FloBundle\Entity\Actualites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Actualite controller.
 *
 */
class ActualitesController extends Controller
{
    /**
     * Lists all actualite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('FloBundle:Actualites')->findAll();

        return $this->render('@Flo/Admin/actualites/index.html.twig', array(
            'actualites' => $actualites,
        ));
    }

    /**
     * Creates a new actualite entity.
     *
     */
    public function newAction(Request $request)
    {
        $actualite = new Actualites();

        $date = $actualite->setDate(new \DateTime('now'));
        $form = $this->createForm('FloBundle\Form\ActualitesType', $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $actualite->getImage()->upload($actualite->getImage()->files);

            $em->persist($actualite);
            $em->flush($actualite);

            return $this->redirectToRoute('actualites_index', array('id' => $actualite->getId()));
        }

        return $this->render('@Flo/Admin/actualites/new.html.twig', array(
            'actualite' => $actualite,
            'date' => $date,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing actualite entity.
     *
     */
    public function editAction(Request $request, Actualites $actualite)
    {

        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('FloBundle:Image')->findOneById($actualite->getImage()->getId());

        $editForm = $this->createForm('FloBundle\Form\ActualitesType', $actualite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() or $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $actualite->getImage()->upload($actualite->getImage()->files);

            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('actualites_index', array('id' => $actualite->getId()));
        }

        return $this->render('@Flo/Admin/actualites/edit.html.twig', array(
            'actualite' => $actualite,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a actualite entity.
     *
     */
    public function deleteAction($id)
    {
        if ($id) {
            $em = $this->getDoctrine()->getManager();
            $actualites = $em->getRepository('FloBundle:Actualites')->findOneById($id);
            $image = $em->getRepository('FloBundle:Image')->findOneById($actualites->getImage()->getId());
            $em->remove($actualites);
            $em->remove($image);
            $em->flush();

            return $this->redirectToRoute('actualites_index');
        } else
            return $this->redirectToRoute('actualites_index');

    }
}
