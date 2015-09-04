<?php

namespace Naissance\ApplicationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Naissance\ApplicationBundle\Entity\Reference;
use Naissance\ApplicationBundle\Form\ReferenceType;

/**
 * Reference controller.
 *
 */
class ReferenceController extends Controller
{

    /**
     * Lists all Reference entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NaissanceApplicationBundle:Reference')->findAll();

        return $this->render('NaissanceApplicationBundle:Reference:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Reference entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Reference();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reference_show', array('id' => $entity->getId())));
        }

        return $this->render('NaissanceApplicationBundle:Reference:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Reference entity.
     *
     * @param Reference $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Reference $entity)
    {
        $form = $this->createForm(new ReferenceType(), $entity, array(
            'action' => $this->generateUrl('reference_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Reference entity.
     *
     */
    public function newAction()
    {
        $entity = new Reference();
        $form   = $this->createCreateForm($entity);

        return $this->render('NaissanceApplicationBundle:Reference:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Reference entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Reference')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reference entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NaissanceApplicationBundle:Reference:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Reference entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Reference')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reference entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NaissanceApplicationBundle:Reference:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Reference entity.
    *
    * @param Reference $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Reference $entity)
    {
        $form = $this->createForm(new ReferenceType(), $entity, array(
            'action' => $this->generateUrl('reference_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Reference entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Reference')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reference entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('reference_edit', array('id' => $id)));
        }

        return $this->render('NaissanceApplicationBundle:Reference:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Reference entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NaissanceApplicationBundle:Reference')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reference entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reference'));
    }

    /**
     * Creates a form to delete a Reference entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reference_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
