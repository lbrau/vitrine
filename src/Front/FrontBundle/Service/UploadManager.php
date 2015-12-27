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
 * Manage all documents uploaded.
 *
 * Class UploadManager
 * @package Front\FrontBundle\Service
 */
class UploadManager {

    private $rootDir;

    const PATH_DIRECTORY = '/../web/uploads/contact_letters';
    const PATH_IMAGE_VIEW = '/uploads/contact_letters';

    /**
     * Initialize dependency injections
     *
     * @param $rootDir
     */
    public function __construct($rootDir) {
        $this->rootDir = $rootDir;
    }

    /**
     * Manage upload action
     *
     * @param $contactMessage
     */
    public function uploadDocument(Contact $contactMessage) {
        try {
            $file = $contactMessage->getFile();
            $contactDirectory = $this->rootDir.self::PATH_DIRECTORY;
            $pathFile = $contactDirectory.'/'.$file->getClientOriginalName();
            // ---- Path where image uploaded sent ----
            $file->move($contactDirectory, $file->getClientOriginalName());
            // ---- Path about web image path for displayed ----
            $contactMessage->setFile(self::PATH_IMAGE_VIEW.'/'.$file->getClientOriginalName());
        } catch (Exception $e) {
            echo "L'upload de l'image a échoué pour une raison suivante : ".$e->getMessage();
        }

        return $pathFile;

    }
}