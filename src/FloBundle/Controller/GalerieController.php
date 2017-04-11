<?php

namespace FloBundle\Controller;

use FloBundle\Entity\Galerie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Galerie controller.
 *
 */
class GalerieController extends Controller
{
    /**
     * Lists all galerie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galeries = $em->getRepository('FloBundle:Galerie')->findAll();

        return $this->render('@Flo/Admin/galerie/index.html.twig', array(
            'galeries' => $galeries,
        ));
    }

    /**
     * Creates a new galerie entity.
     *
     */
    public function newAction(Request $request)
    {
        $galerie = new Galerie();
        $form = $this->createForm('FloBundle\Form\GalerieType', $galerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($galerie);
            $em->flush();

            return $this->redirectToRoute('galerie_index', array('id' => $galerie->getId()));
        }

        return $this->render('@Flo/Admin/galerie/new.html.twig', array(
            'galerie' => $galerie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing galerie entity.
     *
     */
    public function editAction(Request $request, Galerie $galerie)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('FloBundle:Image')->findOneById($galerie->getImage()->getId());

        $editForm = $this->createForm('FloBundle\Form\GalerieType', $galerie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() or $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image->preUpload();

            $em->persist($galerie);
            $em->flush();

            return $this->redirectToRoute('galerie_edit', array('id' => $galerie->getId()));
        }

        return $this->render('@Flo/Admin/galerie/edit.html.twig', array(
            'galerie' => $galerie,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a galerie entity.
     *
     */
    public function deleteAction($id)
    {
        if ($id) {
            $em = $this->getDoctrine()->getManager();
            $galerie = $em->getRepository('FloBundle:Galerie')->findOneById($id);
            $image = $em->getRepository('FloBundle:Image')->findOneById($galerie->getImage()->getId());
            $em->remove($galerie);
            $em->remove($image);
            $em->flush();

            return $this->redirectToRoute('galerie_index');
        } else
            return $this->redirectToRoute('galerie_index');

    }
}
