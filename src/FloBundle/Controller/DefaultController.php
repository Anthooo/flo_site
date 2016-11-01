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

    public function mailAction()
    {
        return $this->render('@Flo/User/confirm.html.twig');
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
                    '@Flo/User/mail.html.twig',
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
        return $this->render('@Flo/User/confirm.html.twig');

    }
}
