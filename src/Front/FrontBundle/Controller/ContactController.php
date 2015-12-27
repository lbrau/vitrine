<?php

namespace Front\FrontBundle\Controller;

use Back\BackBundle\Entity\Commentary;
use Back\BackBundle\Form\CommentaryType;
use Back\BackBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Back\BackBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\File\File;


class ContactController extends Controller
{

    /**
     * Display the wall
     *
     * @Route("/contactMessage/", name="contactMessage")
     * @Method("GET|POST")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contactMessage = new Contact();
        $confirmMessage = null;
        $form = $this->createForm(new ContactType(), $contactMessage);
        $picPath= '';
        if ($request->isMethod('post')) {
        $form->handleRequest($request);
            if ($form->isValid()) {
                $pathFile = $this->container->get('front.upload_manager')->uploadDocument($contactMessage);
                $confirmMessage = "Message envoyé ";
                $picPath = $contactMessage->getFile();
                $this->get('session')->getFlashBag()->add('success', 'Votre message a bien été envoyé !');
                $em->persist($contactMessage);
                $em->flush();
                $form = $this->createForm(new ContactType());

                $message = \Swift_Message::newInstance()
                    ->setSubject('confirm')
                    ->setFrom('send@example.com')
                    ->setTo('laurent.brau@gmail.com');

                // TODO voir pour mettre tout les paht file des images pour alimenter le template.
                // TODO le path file correspond au web path des images.
                $data = $message->embed(\Swift_Image::fromPath($pathFile));
                $message
                    ->setBody(
                        $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                            'FrontFrontBundle:templates_mail:default.html.twig',
                            array(
                                'path' => $picPath,
                                'image_src' => $data
                            )
                        ),
                        'text/html'
                    )

                    ->attach(\Swift_Attachment::fromPath($pathFile))
                    /*
                     * If you also want to include a plaintext version of the message
                    ->addPart(
                        $this->renderView(
                            'Emails/registration.txt.twig',
                            array('name' => $name)
                        ),
                        'text/plain'
                    )
                    */
                ;

                $this->get('mailer')->send($message);

//                return $this->render('FrontFrontBundle:Contact:confirmation.html.twig', array('confirmMessage' => $confirmMessage));
            } else {
                foreach ($form->getErrors() as $er) {
                    echo $er->count() . ' | ';
                    echo $er->getMessage() . ' ';
                    echo $er->current();
                }
                $this->get('session')->getFlashBag()
                    ->add('error', 'Erreur : Les données n\'ont pas été validé par l\'application!');
                foreach ($form->getErrors() as $error) {
                    $this->get('session')->getFlashBag()
                        ->add('error', "Il semblerait que l'image n'est pas passé la validation requise.");
                }
//                $this->get('session')->getFlashBag()->add('error', 'Erreur : '.$error[0]->getMessage().'!');
//                var_dump('not valid', $form->getData(), $_FILES, $form->getErrors());die;
            }
        }

        return array(
            'contactMessage' => $contactMessage,
            'form' => $form->createView(),
            'contactMessage' => $confirmMessage,
            'picPath' => $picPath
        );
    }
}
