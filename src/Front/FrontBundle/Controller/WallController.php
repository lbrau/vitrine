<?php

namespace Front\FrontBundle\Controller;

use Back\BackBundle\Entity\Commentary;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WallController extends Controller
{
    /**
     * Display the wall
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('BackBackBundle:Article')->findAll();

        return array('articles' => $articles);
    }
}
