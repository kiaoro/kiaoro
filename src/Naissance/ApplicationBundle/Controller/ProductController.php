<?php

namespace Naissance\ApplicationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Naissance\ApplicationBundle\Entity\Product;
use Naissance\ApplicationBundle\Entity\Wishlist;
use Naissance\ApplicationBundle\Form\ProductType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{

    /**
     * Lists all Product entities.
     *
     */
    public function indexAction($wishlistId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $wishlist = $em->getRepository('NaissanceApplicationBundle:Wishlist')->findOneBy(array('id' => $wishlistId, 'user' => $user));
        if (!$wishlist) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }
        $products = $em->getRepository('NaissanceApplicationBundle:Product')->findByWishlist($wishlist);
        return $this->render('NaissanceApplicationBundle:Product:index.html.twig', array(
            'wishlist' => $wishlist, 
            'products' => $products,
        ));
    }

    /**
     * Creates a new Product entity.
     *
     */
    public function createAction(Request $request, $wishlistId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $wishlist = $em->getRepository('NaissanceApplicationBundle:Wishlist')->findOneBy(array('id' => $wishlistId, 'user' => $user));
        if (!$wishlist) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }
        $product = new Product();
        $product->setWishlist($wishlist);
        $form = $this->createCreateForm($product);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($product);
            $em->flush();
            return $this->redirect($this->generateUrl('product', array('wishlistId' => $wishlist->getId())));
        }
        return $this->render('NaissanceApplicationBundle:Product:new.html.twig', array(
            'wishlist' => $wishlist, 
            'product'  => $product,
            'form'     => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Product $product)
    {
        $form = $this->createForm(new ProductType(), $product, array(
            'action' => $this->generateUrl('product_create', array('wishlistId' => $product->getWishlist()->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Product entity.
     *
     */
    public function newAction($wishlistId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $wishlist = $em->getRepository('NaissanceApplicationBundle:Wishlist')->findOneBy(array('id' => $wishlistId, 'user' => $user));
        if (!$wishlist) {
            throw $this->createNotFoundException('Unable to find Wishlist entity.');
        }
        $product = new Product();
        $product->setWishlist($wishlist);
        $form  = $this->createCreateForm($product);
        return $this->render('NaissanceApplicationBundle:Product:new.html.twig', array(
            'wishlist' => $wishlist, 
            'product' => $product,
            'form'    => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NaissanceApplicationBundle:Product:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NaissanceApplicationBundle:Product:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Product entity.
    *
    * @param Product $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Product $entity)
    {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('product_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Product entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NaissanceApplicationBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('product_edit', array('id' => $id)));
        }

        return $this->render('NaissanceApplicationBundle:Product:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Product entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NaissanceApplicationBundle:Product')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('product'));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    public function addToWishlistAction(Request $request, $wishlistId, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $wishlist = $em->getRepository('NaissanceApplicationBundle:Wishlist')->getWishlistByWishlistIdAndUser($wishlistId, $user);
        $product  = $em->getRepository('NaissanceApplicationBundle:Product')->find($id);
        if (!$wishlist || !$product) {
            throw $this->createNotFoundException('Unable to find entity.');
        }
        $reference = new Reference();
        $reference->setLevel(1);
        $reference->setWishlist($wishlist);
        $reference->setProduct($product);
        try {
            $em->persist($reference);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Product added to wishlist!');
        }
        catch (\Doctrine\DBAL\DBALException $e) {
        }
        return $this->redirect($this->generateUrl('product', array('wishlistId' => $wishlistId)));
    }


    public function removeFromWishlistAction(Request $request, $wishlistId, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $wishlist  = $em->getRepository('NaissanceApplicationBundle:Wishlist')->getWishlistByWishlistIdAndUser($wishlistId, $user);
        $product   = $em->getRepository('NaissanceApplicationBundle:Product')->find($id);
        $reference = $em->getRepository('NaissanceApplicationBundle:Reference')->findOneBy(array('wishlist' => $wishlist, 'product'  => $product)); 
        if (!$reference) {
            throw $this->createNotFoundException('Unable to find entity.');
        }
        try {
            $em->remove($reference);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Product removed from wishlist!');
        }
        catch (\Doctrine\DBAL\DBALException $e) {
        } 
        return $this->redirect($this->generateUrl('wishlist_show', array('id' => $wishlistId)));
    }
}
