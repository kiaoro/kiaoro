<?php

namespace Naissance\ApplicationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $wishlists = $em->getRepository('NaissanceApplicationBundle:Wishlist')->findByUser($user);
        return $this->render('NaissanceApplicationBundle:Wishlist:index.html.twig', array(
            'wishlists' => $wishlists,
        ));
    }

    /**
     * Creates a new Wishlist entity.
     *
     */
    public function createAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $wishlist = new Wishlist();
        $wishlist->setUser($user);
        $form = $this->createCreateForm($wishlist);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wishlist);
            $em->flush();

            return $this->redirect($this->generateUrl('wishlist'));
        }

        return $this->render('NaissanceApplicationBundle:Wishlist:new.html.twig', array(
            'entity' => $wishlist,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Wishlist entity.
     *
     * @param Wishlist $wishlist The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Wishlist $wishlist)
    {
        $form = $this->createForm(new WishlistType(), $wishlist, array(
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
        // if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
        //     throw new AccessDeniedException();
        // }
        $wishlist = new Wishlist();
        $form = $this->createCreateForm($wishlist);
        return $this->render('NaissanceApplicationBundle:Wishlist:new.html.twig', array(
            'wishlist' => $wishlist,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Wishlist entity.
     *
     */
    public function showAction($wishlistId)
    {
        $em = $this->getDoctrine()->getManager();
        $wishlist = $em->getRepository('NaissanceApplicationBundle:Wishlist')->findOneById($wishlistId);
        if (!$wishlist) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }
        $deleteForm = $this->createDeleteForm($wishlistId);
        return $this->render('NaissanceApplicationBundle:Wishlist:show.html.twig', array(
            'wishlist'    => $wishlist,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Wishlist entity.
     *
     */
    public function editAction($wishlistId)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $wishlist = $em->getRepository('NaissanceApplicationBundle:Wishlist')->findOneBy(array('id' => $wishlistId, 'user' => $user));
        if (!$wishlist) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }
        $editForm = $this->createEditForm($wishlist);
        $deleteForm = $this->createDeleteForm($wishlistId);
        return $this->render('NaissanceApplicationBundle:Wishlist:edit.html.twig', array(
            'wishlist'    => $wishlist,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Wishlist entity.
    *
    * @param Wishlist $wishlist The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Wishlist $wishlist)
    {
        $form = $this->createForm(new WishlistType(), $wishlist, array(
            'action' => $this->generateUrl('wishlist_update', array('wishlistId' => $wishlist->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        return $form;
    }

    /**
     * Edits an existing Wishlist entity.
     *
     */
    public function updateAction(Request $request, $wishlistId)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $wishlist = $em->getRepository('NaissanceApplicationBundle:Wishlist')->findOneBy(array('id' => $wishlistId, 'user' => $user));
        if (!$wishlist) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }
        $deleteForm = $this->createDeleteForm($wishlistId);
        $editForm = $this->createEditForm($wishlist);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('wishlist_edit', array('wishlistId' => $wishlistId)));
        }
        return $this->render('NaissanceApplicationBundle:Wishlist:edit.html.twig', array(
            'wishlist'    => $wishlist,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Wishlist entity.
     *
     */
    public function deleteAction(Request $request, $wishlistId)
    {
        $form = $this->createDeleteForm($wishlistId);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $wishlist = $em->getRepository('NaissanceApplicationBundle:Wishlist')->find($wishlistId);
            if (!$wishlist) {
                throw $this->createNotFoundException('Unable to find Wishlist entity.');
            }
            $em->remove($wishlist);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('wishlist'));
    }

    /**
     * Creates a form to delete a Wishlist entity by id.
     *
     * @param mixed $wishlistId The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($wishlistId)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wishlist_delete', array('wishlistId' => $wishlistId)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
