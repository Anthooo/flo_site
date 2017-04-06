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
        $form = $this->createForm('FloBundle\Form\ActualitesType', $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush($actualite);

            return $this->redirectToRoute('actualites_show', array('id' => $actualite->getId()));
        }

        return $this->render('@Flo/Admin/actualites/new.html.twig', array(
            'actualite' => $actualite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a actualite entity.
     *
     */
    public function showAction(Actualites $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);

        return $this->render('@Flo/Admin/actualites/show.html.twig', array(
            'actualite' => $actualite,
            'delete_form' => $deleteForm->createView(),
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

        $deleteForm = $this->createDeleteForm($actualite);
        $editForm = $this->createForm('FloBundle\Form\ActualitesType', $actualite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() or $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image->preUpload();

            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('actualites_index', array('id' => $actualite->getId()));
        }

        return $this->render('@Flo/Admin/actualites/edit.html.twig', array(
            'actualite' => $actualite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a actualite entity.
     *
     */
    public function deleteAction(Request $request, Actualites $actualite)
    {
        $form = $this->createDeleteForm($actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actualite);
            $em->flush($actualite);
        }

        return $this->redirectToRoute('actualites_index');
    }

    /**
     * Creates a form to delete a actualite entity.
     *
     * @param Actualites $actualite The actualite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Actualites $actualite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actualites_delete', array('id' => $actualite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
