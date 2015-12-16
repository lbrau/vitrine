<?php

namespace Front\FrontBundle\Controller;

use Back\BackBundle\Entity\Commentary;
use Back\BackBundle\Form\CommentaryType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactController extends Controller
{
    /**
     * Display the wall
     *
     * @Route("/contact", name="contact")
     * @Method("GET|POST")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder()
            ->add('nom','text')
            ->add('type', 'choice', array(
                'choices'  => array(
                    'Particulier' => null,
                    'Professionnel' => true
                ),
                'choices_as_values' => true,
            ))
            ->add('domaine', 'choice', array(
                'choices'  => array(
                    'Choisissez le type de question' => null,
                    'Carrière' => null,
                    'Question technique' => true,
                    'Autres' => true
                ),
                'choices_as_values' => true,
            ))
            ->add('file', 'file')
            ->getForm()
            ;
        if ($request->isMethod('post')) {
            var_dump("VALIDATOR",$request->request);die;
        }

        return array(
//            'form' => $form->createView()
        );
    }
}
