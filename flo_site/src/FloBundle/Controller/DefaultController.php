<?php

namespace FloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FloBundle:Default:index.html.twig');
    }

    public function adminAction()
    {
        return $this->render('@Flo/Admin/index.html.twig');
    }

    public function oeuvresAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository("FloBundle:Categorie")->getModeleByCateg('Oeuvres');
        return $this->render('@Flo/User/oeuvres.html.twig', array(
            'modeles'=>$modeles
        ));
    }

    public function fictionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository('FloBundle:Categorie')->getModeleByCateg('Fictions');
        return $this->render('@Flo/User/fictions.html.twig', array(
            'modeles' => $modeles
        ));
    }

    public function coursAction()
    {
        return $this->render('@Flo/User/cours.html.twig');
    }

    public function aboutAction()
    {
        $em = $this->getDoctrine()->getManager();
        $abouts = $em->getRepository("FloBundle:About")->findBy(array(), array('date'=>'desc'));
        return $this->render('@Flo/user/about.html.twig', array(
            'abouts'=>$abouts
        ));
    }

    public function contactAction()
    {
        return $this->render('@Flo/User/contact.html.twig');
    }


}
