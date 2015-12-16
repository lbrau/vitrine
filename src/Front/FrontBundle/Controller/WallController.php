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

class WallController extends Controller
{
    /**
     * Display the wall
     *
     * @Route("/")
     * @Method("GET|POST")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('BackBackBundle:Article')->findAll();
//        var_dump($articles[0]->getCommentaries()[0]->getCommentaryContent());die;

        return array('articles' => $articles);
    }

    /**
     * Display the wall
     *
     * @Route("/ajaxtest")
     * @Method("POST")
     */
    public function ajax(Request $request)
    {

        // TODO pour la validation de la requette ajax, il faudra faire
        // TODO une hydration avec le handle, puis un mail pour signaler l'ajout d'un nouveau commentaire.
        $em = $this->getDoctrine()->getManager();
        // ---- Format data from post request ----
        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);
        die('fin');
        // ---- hydrate a new commentary ----
        $commentary = new Commentary();
//        $commentaryContent = $request->request->get('commentary');
//        $commentary->setCommentaryContent($commentaryContent);
//        $authorName = $request->request->get('author_commentary');
//        $commentary->setCommentaryAuthor($authorName);
//        $commentary->setEnabled(true);
//        $article_id = $request->request->get('article_id');
//        $article = $em->getRepository('BackBackBundle:Article')->find($article_id);
//        $commentary->setArticle($article);
        // ---- create commentary validator ----
        // ---- create a form commentary ----
        $form = $this->createForm(new CommentaryType(), $commentary);
        $form->handleRequest($request);
        $em->persist($commentary);
        $em->flush();
        die;



        return new JsonResponse(array('datoum' => 'tortues les data'));
    }
}
