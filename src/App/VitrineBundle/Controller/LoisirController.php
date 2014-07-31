<?php

namespace App\VitrineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\VitrineBundle\Entity\Loisir;
use App\VitrineBundle\Form\LoisirType;

/**
 * Loisir controller.
 *
 * @Route("/loisir")
 */
class LoisirController extends Controller
{

    /**
     * Lists all Loisir entities.
     *
     * @Route("/", name="loisir")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppVitrineBundle:Loisir')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Loisir entity.
     *
     * @Route("/", name="loisir_create")
     * @Method("POST")
     * @Template("AppVitrineBundle:Loisir:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Loisir();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('loisir_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Loisir entity.
    *
    * @param Loisir $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Loisir $entity)
    {
        $form = $this->createForm(new LoisirType(), $entity, array(
            'action' => $this->generateUrl('loisir_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Loisir entity.
     *
     * @Route("/new", name="loisir_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Loisir();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Loisir entity.
     *
     * @Route("/{id}", name="loisir_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppVitrineBundle:Loisir')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Loisir entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Loisir entity.
     *
     * @Route("/{id}/edit", name="loisir_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppVitrineBundle:Loisir')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Loisir entity.');
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
    * Creates a form to edit a Loisir entity.
    *
    * @param Loisir $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Loisir $entity)
    {
        $form = $this->createForm(new LoisirType(), $entity, array(
            'action' => $this->generateUrl('loisir_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Loisir entity.
     *
     * @Route("/{id}", name="loisir_update")
     * @Method("PUT")
     * @Template("AppVitrineBundle:Loisir:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppVitrineBundle:Loisir')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Loisir entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('loisir_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Loisir entity.
     *
     * @Route("/{id}", name="loisir_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppVitrineBundle:Loisir')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Loisir entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('loisir'));
    }

    /**
     * Creates a form to delete a Loisir entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('loisir_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
