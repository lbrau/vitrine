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
     * Methode test pour unit test
     *
     * @param $a
     * @param $b
     * @return int|string
     */
    public  function addition($a, $b) {

        $result = "paramètres invalides";
        if (is_int($a) && is_int($b)) {
            $result = $a + $b;
        }

        return $result;
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
            // ---- Generate absolute path ----
            $pathFile = $contactDirectory.'/'.$file->getClientOriginalName();
            // ---- Path where image uploaded sent ----
            $file->move($contactDirectory, $file->getClientOriginalName());
            // ---- Path about web image path for displayed ----
            $contactMessage->setFile(self::PATH_IMAGE_VIEW.'/'.$file->getClientOriginalName());
        } catch (Exception $e) {
            echo "Upload failed : ".$e->getMessage();
        }

        return $pathFile;
    }

    /**
     * File constraints controls from upload form.
     *
     * @param $fileData
     */
    public function uploadValidatorConstaints($fileData) {
        if ('image/jpeg' == $fileData[0]) {
            return true;
        } else {
            return false;
        }
    }
}