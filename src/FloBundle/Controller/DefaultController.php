<?php

namespace FloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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

    public function GalerieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $galeries = $em->getRepository("FloBundle:Galerie")->findAll();
        return $this->render('@Flo/user/oeuvres.html.twig', array(
            'galeries'=>$galeries
        ));
    }

    public function fictionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository('FloBundle:Categorie')->getModeleByCateg('Fictions');
        return $this->render('@Flo/user/fictions.html.twig', array(
            'modeles' => $modeles
        ));
    }

    public function coursAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("FloBundle:Cours")->findAll();
        $img = $em->getRepository("FloBundle:Image")->findAll();
        return $this->render('@Flo/user/cours.html.twig', array(
            'cours'=>$cours
        ));
    }

    public function stagesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository("FloBundle:Categorie")->getModeleByCateg('Stages');
        return $this->render('@Flo/user/stages.html.twig', array(
            'modeles'=>$modeles
        ));
    }

    public function ActuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actualites = $em->getRepository("FloBundle:Actualites")->findAll();
        return $this->render('@Flo/user/actualites.html.twig', array(
            'actualites'=>$actualites
        ));
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
        return $this->render('@Flo/user/contact.html.twig');
    }

    public function mailAction()
    {
        return $this->render('@Flo/user/confirm.html.twig');
    }

    public function sendAction(Request $request)
    {
        $from = $this->getParameter('mailer_user');
        $name = $request->request->get('nom');
        $firstname = $request->request->get('prenom');
        $mail = $request->request->get('email');
//        $sujet = $request->request->get('Sujet');
        $msg = $request->request->get('msg');

        $message = \Swift_Message::newInstance()
            ->setSubject('Contact Site')
            ->setFrom(array($from => 'Florence Menet-Pélisson'))
            ->setTo($from)
            ->setBody(
                $this->renderView(
                    '@Flo/user/mail.html.twig',
                    array(
                        'nom' => $name,
                        'prenom' => $firstname,
                        'email' => $mail,
//                        'sujet' => $sujet,
                        'msg' => $msg
                    )
                ),
                'text/html'
            );

        $this->get('mailer')->send($message);
        return $this->render('@Flo/user/confirm.html.twig');

    }
}
