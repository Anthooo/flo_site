<?php

namespace FloBundle\Controller;

use FloBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categorie controller.
 *
 */
class CategorieController extends Controller
{
    /**
     * Lists all categorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('FloBundle:Categorie')->findAll();

        return $this->render('@Flo/Admin/categorie/index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new categorie entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorie = new Categorie();
        $form = $this->createForm('FloBundle\Form\CategorieType', $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush($categorie);

            return $this->redirectToRoute('categorie_index', array('id' => $categorie->getId()));
        }

        return $this->render('@Flo/Admin/categorie/new.html.twig', array(
            'categorie' => $categorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorie entity.
     *
     */
    public function showAction(Categorie $categorie)
    {
        $deleteForm = $this->createDeleteForm($categorie);

        return $this->render('@Flo/Admin/categorie/index.html.twig', array(
            'categorie' => $categorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorie entity.
     *
     */
    public function editAction(Request $request, Categorie $categorie)
    {
        $editForm = $this->createForm('FloBundle\Form\CategorieType', $categorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_edit', array('id' => $categorie->getId()));
        }

        return $this->render('@Flo/Admin/categorie/edit.html.twig', array(
            'categorie' => $categorie,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a categorie entity.
     *
     */
    public function deleteAction($id)
    {
        if ($id) {
            $em = $this->getDoctrine()->getManager();
            $categorie = $em->getRepository('FloBundle:Categorie')->findOneById($id);
            $em->remove($categorie);
            $em->flush();

            return $this->redirectToRoute('categorie_index');
        } else
            return $this->redirectToRoute('categorie_index');

    }
}
