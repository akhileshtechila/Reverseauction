<?php

namespace ReverseAuction\ReverseAuctionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo;
use ReverseAuction\ReverseAuctionBundle\Form\ProductInfoType;

/**
 * ProductInfo controller.
 *
 */
class ProductInfoController extends Controller
{

    /**
     * Lists all ProductInfo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ReverseAuctionReverseAuctionBundle:ProductInfo')->findAll();

        return $this->render('ReverseAuctionReverseAuctionBundle:ProductInfo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ProductInfo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductInfo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setMailsendflag(0);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productinfo_show', array('id' => $entity->getId())));
        }

        return $this->render('ReverseAuctionReverseAuctionBundle:ProductInfo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProductInfo entity.
     *
     * @param ProductInfo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductInfo $entity)
    {
        $form = $this->createForm(new ProductInfoType(), $entity, array(
            'action' => $this->generateUrl('productinfo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductInfo entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductInfo();
        $form   = $this->createCreateForm($entity);

        return $this->render('ReverseAuctionReverseAuctionBundle:ProductInfo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductInfo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:ProductInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductInfo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ReverseAuctionReverseAuctionBundle:ProductInfo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductInfo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:ProductInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductInfo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ReverseAuctionReverseAuctionBundle:ProductInfo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProductInfo entity.
    *
    * @param ProductInfo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductInfo $entity)
    {
        $form = $this->createForm(new ProductInfoType(), $entity, array(
            'action' => $this->generateUrl('productinfo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductInfo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:ProductInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductInfo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('productinfo_edit', array('id' => $id)));
        }

        return $this->render('ReverseAuctionReverseAuctionBundle:ProductInfo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductInfo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:ProductInfo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductInfo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('productinfo'));
    }

    /**
     * Creates a form to delete a ProductInfo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productinfo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
