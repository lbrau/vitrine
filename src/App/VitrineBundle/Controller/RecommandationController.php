<?php

namespace App\VitrineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\VitrineBundle\Entity\Recommandation;
use App\VitrineBundle\Form\RecommandationType;

/**
 * Recommandation controller.
 *
 * @Route("/recommandation")
 */
class RecommandationController extends Controller
{

    /**
     * Lists all Recommandation entities.
     *
     * @Route("/", name="recommandation")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppVitrineBundle:Recommandation')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Recommandation entity.
     *
     * @Route("/", name="recommandation_create")
     * @Method("POST")
     * @Template("AppVitrineBundle:Recommandation:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Recommandation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recommandation_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Recommandation entity.
    *
    * @param Recommandation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Recommandation $entity)
    {
        $form = $this->createForm(new RecommandationType(), $entity, array(
            'action' => $this->generateUrl('recommandation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Recommandation entity.
     *
     * @Route("/new", name="recommandation_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Recommandation();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Recommandation entity.
     *
     * @Route("/{id}", name="recommandation_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppVitrineBundle:Recommandation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommandation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Recommandation entity.
     *
     * @Route("/{id}/edit", name="recommandation_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppVitrineBundle:Recommandation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommandation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Recommandation entity.
    *
    * @param Recommandation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Recommandation $entity)
    {
        $form = $this->createForm(new RecommandationType(), $entity, array(
            'action' => $this->generateUrl('recommandation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Recommandation entity.
     *
     * @Route("/{id}", name="recommandation_update")
     * @Method("PUT")
     * @Template("AppVitrineBundle:Recommandation:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppVitrineBundle:Recommandation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recommandation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('recommandation_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Recommandation entity.
     *
     * @Route("/{id}", name="recommandation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppVitrineBundle:Recommandation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recommandation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('recommandation'));
    }

    /**
     * Creates a form to delete a Recommandation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recommandation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
