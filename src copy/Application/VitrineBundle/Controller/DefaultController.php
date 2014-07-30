<?php

namespace Application\VitrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ApplicationVitrineBundle:Default:index.html.twig', array('name' => $name));
    }
}
