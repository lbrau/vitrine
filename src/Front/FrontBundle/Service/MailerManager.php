<?php

namespace Front\FrontBundle\Service;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Back\BackBundle\Entity\Article;
use Back\BackBundle\Form\ArticleType;
use Back\BackBundle\Entity\Contact;


/**
 * Manage emails streams.
 *
 * Class MailerManager
 * @package Front\FrontBundle\Service
 */
class MailerManager {

    const HEADER_PIC_PATH_TPL = "../web/templates/images/admin/header_pic_notification.jpg";

    private $swiftMailer;
    private $rootDir;

    /**
     * Manage depency injections
     *
     * @param Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer, $rootDir) {
        $this->swiftMailer = $mailer;
        $this->rootDir = $rootDir;
    }

    /**
     *
     *
     * @param $pathFile
     * @param $picPath
     */
    public function sendNotificationContact($pathFile, $contactMessage, $that) {
        $message = \Swift_Message::newInstance()
            ->setSubject('confirm')
            ->setFrom('send@example.com')
            ->setTo('laurent.brau@gmail.com');
        // TODO voir pour mettre tout les path file des images pour alimenter le template.
        // TODO le path file correspond au web path des images.
        $headerPic = $this->rootDir.'/'.self::HEADER_PIC_PATH_TPL;
        dump($headerPic);
        $data = $message->embed(\Swift_Image::fromPath($headerPic));
        $message
            ->setBody(
                $that->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'FrontFrontBundle:templates_mail:default.html.twig',
                    array(
                        'message' => $contactMessage,
                        'image_src' => $data
                    )
                ),
                'text/html'
            )
            ->attach(\Swift_Attachment::fromPath($pathFile))

        ;
        $that->get('mailer')->send($message);
    }
}