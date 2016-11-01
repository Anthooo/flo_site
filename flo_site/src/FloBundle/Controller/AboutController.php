<?php

namespace FloBundle\Controller;

use FloBundle\Entity\About;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * About controller.
 *
 */
class AboutController extends Controller
{
    /**
     * Lists all about entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $abouts = $em->getRepository('FloBundle:About')->findAll();

        return $this->render('@Flo/Admin/about/index.html.twig', array(
            'abouts' => $abouts,
        ));
    }

    /**
     * Creates a new about entity.
     *
     */
    public function newAction(Request $request)
    {
        $about = new About();
        $form = $this->createForm('FloBundle\Form\AboutType', $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($about);
            $em->flush($about);

            return $this->redirectToRoute('about_index', array('id' => $about->getId()));
        }

        return $this->render('@Flo/Admin/about/new.html.twig', array(
            'about' => $about,
            'form' => $form->createView(),
        ));
    }

//
    /**
     * Displays a form to edit an existing about entity.
     *
     */
    public function editAction(Request $request, About $about)
    {
        $editForm = $this->createForm('FloBundle\Form\AboutType', $about);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($about);
            $em->flush();

            return $this->redirectToRoute('about_index', array('id' => $about->getId()));
        }

        return $this->render('@Flo/Admin/about/edit.html.twig', array(
            'about' => $about,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a about entity.
     *
     */

    public function deleteAction($id)
    {
        if ($id) {
            $em = $this->getDoctrine()->getEntityManager();
            $about = $em->getRepository('FloBundle:About')->findOneById($id);
            $em->remove($about);
            $em->flush();

            return $this->redirectToRoute('about_index');
        } else
            return $this->redirectToRoute('about_index');

    }
}
