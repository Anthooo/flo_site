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
}
