<?php

namespace ReverseAuction\ReverseAuctionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo;
use ReverseAuction\ReverseAuctionBundle\Form\BidsInfoType;

/**
 * BidsInfo controller.
 *
 */
class BidsInfoController extends Controller
{

    /**
     * Lists all BidsInfo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ReverseAuctionReverseAuctionBundle:BidsInfo')->findbidWinnerQuery(10);

        return $this->render('ReverseAuctionReverseAuctionBundle:BidsInfo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new BidsInfo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new BidsInfo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bidsinfo_show', array('id' => $entity->getId())));
        }

        return $this->render('ReverseAuctionReverseAuctionBundle:BidsInfo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a BidsInfo entity.
     *
     * @param BidsInfo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BidsInfo $entity)
    {
        $form = $this->createForm(new BidsInfoType(), $entity, array(
            'action' => $this->generateUrl('bidsinfo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BidsInfo entity.
     *
     */
    public function newAction()
    {
        $entity = new BidsInfo();
        $form   = $this->createCreateForm($entity);

        return $this->render('ReverseAuctionReverseAuctionBundle:BidsInfo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BidsInfo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:BidsInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BidsInfo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ReverseAuctionReverseAuctionBundle:BidsInfo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BidsInfo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:BidsInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BidsInfo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ReverseAuctionReverseAuctionBundle:BidsInfo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a BidsInfo entity.
    *
    * @param BidsInfo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BidsInfo $entity)
    {
        $form = $this->createForm(new BidsInfoType(), $entity, array(
            'action' => $this->generateUrl('bidsinfo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BidsInfo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:BidsInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BidsInfo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bidsinfo_edit', array('id' => $id)));
        }

        return $this->render('ReverseAuctionReverseAuctionBundle:BidsInfo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a BidsInfo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:BidsInfo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BidsInfo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bidsinfo'));
    }

    /**
     * Creates a form to delete a BidsInfo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bidsinfo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
