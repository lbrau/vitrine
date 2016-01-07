<?php

namespace Front\FrontBundle\Controller;
use Back\BackBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Back\BackBundle\Entity\Contact;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
                // ---- Upload and save the image submitted in formulary ----
                $pathFile = $this->container->get('front.upload_manager')->uploadDocument($contactMessage);
                $confirmMessage = "Message envoyé ";
                $picPath = $contactMessage->getFile();
                $this->get('session')->getFlashBag()->add('success', 'Votre message a bien été envoyé !');
                $em->persist($contactMessage);
                $em->flush();
                // ---- Reset the contact form ----
                $form = $this->createForm(new ContactType());
                // ---- Send email notification message toward administrator ----
                // TODO changer le $pathFile par les images que doivent utiliser le template de mail. Cette variable $pathFile ft juste un test concluant.
                $this->container->get('front.email_manager')->sendNotificationContact($pathFile, $contactMessage, $this);
            } else {
                $this->get('session')->getFlashBag()
                        ->add('error', 'Erreur : Les données n\'ont pas été validé par l\'application!');
            }
        }

        return array(
            'contactMessage' => $contactMessage,
            'form' => $form->createView(),
            'contactMessage' => $confirmMessage,
            'picPath' => $picPath
        );
    }

    /**
     * Check if the file is in a good constraints.
     *
     * @Route("/uploadedFileChecker")
     * @Method("POST")
     */
    public function commentManagerajax(Request $request)
    {
        // ---- Affecte les données soumisent en ajax dans un tableau ----
        $dataFromForm = json_decode($request->getContent());
        $reponse = array();
        if ($request->isMethod('post')) {
            if (!empty($dataFromForm)) {
                // ---- service de validation des contraintes des fichiers uploaded ----
                $isValided = $this->container->get('front.upload_manager')->uploadValidatorConstaints($dataFromForm);
                if ($isValided) {
                    $reponse['motif'] = 'Valid';
                    $reponse['message'] = 'Image validée';
                } else {
                    $reponse['status'] = 'invalid';
                    $reponse['message'] = 'Le fichier Jpeg est invalid';
                }
            } else {
                throw new NotFoundHttpException('No data in ajax request');
            }
        } else {
            throw new NotFoundHttpException('Bad http method');
        }

        return new JsonResponse(array('datoum' => $reponse));
    }
}
