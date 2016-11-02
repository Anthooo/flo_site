<?php

namespace FloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use FloBundle\Entity\Modele;
use FloBundle\Form\ModeleType;

/**
 * Modele controller.
 *
 */
class ModeleController extends Controller
{
    /**
     * Lists all modele entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $modeles = $em->getRepository('FloBundle:Modele')->findAll();

        return $this->render('@Flo/Admin/modele/index.html.twig', array(
            'modeles' => $modeles,
        ));
    }

    /**
     * Creates a new modele entity.
     *
     */
    public function newAction(Request $request)
    {
        $modele = new Modele();
        $form = $this->createForm('FloBundle\Form\ModeleType', $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();

            return $this->redirectToRoute('modele_index', array('id' => $modele->getId()));
        }

        return $this->render('@Flo/Admin/modele/new.html.twig', array(
            'modele' => $modele,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing modele entity.
     *
     */
    public function editAction(Request $request, Modele $modele)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('FloBundle:Image')->findOneById($modele->getImage()->getId());

        $editForm = $this->createForm('FloBundle\Form\ModeleType', $modele);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() or $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image->preUpload();

            $em->persist($modele);
            $em->flush();

            return $this->redirectToRoute('modele_index', array('id' => $modele->getId()));
        }

        return $this->render('@Flo/Admin/modele/edit.html.twig', array(
            'modele' => $modele,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a modele entity.
     *
     */

    public function deleteAction($id)
    {
        if ($id) {
            $em = $this->getDoctrine()->getEntityManager();
            $modele = $em->getRepository('FloBundle:Modele')->findOneById($id);
            $image = $em->getRepository('FloBundle:Image')->findOneById($modele->getImage()->getId());
            $em->remove($modele);
            $em->remove($image);
            $em->flush();

            return $this->redirectToRoute('modele_index');
        } else
            return $this->redirectToRoute('modele_index');

    }

//    /**
//     * Creates a form to delete a modele entity.
//     *
//     * @param Modele $modele The modele entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Modele $modele)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('modele_delete', array('id' => $modele->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
}
