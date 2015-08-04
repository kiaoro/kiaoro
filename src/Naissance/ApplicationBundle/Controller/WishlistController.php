<?php

namespace Naissance\ApplicationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Naissance\ApplicationBundle\Entity\Wishlist;
use Naissance\ApplicationBundle\Form\WishlistType;

/**
 * Wishlist controller.
 *
 */
class WishlistController extends Controller
{

    /**
     * Lists all Wishlist entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NaissanceApplicationBundle:Wishlist')->findAll();

        return $this->render('NaissanceApplicationBundle:Wishlist:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Wishlist entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Wishlist();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('wishlist_show', array('id' => $entity->getId())));
        }

        return $this->render('NaissanceApplicationBundle:Wishlist:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Wishlist entity.
     *
     * @param Wishlist $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Wishlist $entity)
    {
        $form = $this->createForm(new WishlistType(), $entity, array(
            'action' => $this->generateUrl('wishlist_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Wishlist entity.
     *
     */
    public function newAction()
    {
        $entity = new Wishlist();
        $form   = $this->createCreateForm($entity);

        return $this->render('NaissanceApplicationBundle:Wishlist:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Wishlist entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Wishlist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NaissanceApplicationBundle:Wishlist:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Wishlist entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Wishlist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NaissanceApplicationBundle:Wishlist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Wishlist entity.
    *
    * @param Wishlist $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Wishlist $entity)
    {
        $form = $this->createForm(new WishlistType(), $entity, array(
            'action' => $this->generateUrl('wishlist_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Wishlist entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Wishlist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('wishlist_edit', array('id' => $id)));
        }

        return $this->render('NaissanceApplicationBundle:Wishlist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Wishlist entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NaissanceApplicationBundle:Wishlist')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Wishlist entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('wishlist'));
    }

    /**
     * Creates a form to delete a Wishlist entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wishlist_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
