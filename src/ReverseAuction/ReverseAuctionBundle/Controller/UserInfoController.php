<?php

namespace ReverseAuction\ReverseAuctionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ReverseAuction\ReverseAuctionBundle\Entity\UserInfo;
use ReverseAuction\ReverseAuctionBundle\Form\UserInfoType;

/**
 * UserInfo controller.
 *
 */
class UserInfoController extends Controller
{

    /**
     * Lists all UserInfo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ReverseAuctionReverseAuctionBundle:UserInfo')->findAll();

        return $this->render('ReverseAuctionReverseAuctionBundle:UserInfo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new UserInfo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new UserInfo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('userinfo_show', array('id' => $entity->getId())));
        }

        return $this->render('ReverseAuctionReverseAuctionBundle:UserInfo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserInfo entity.
     *
     * @param UserInfo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserInfo $entity)
    {
        $form = $this->createForm(new UserInfoType(), $entity, array(
            'action' => $this->generateUrl('userinfo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserInfo entity.
     *
     */
    public function newAction()
    {
        $entity = new UserInfo();
        $form   = $this->createCreateForm($entity);

        return $this->render('ReverseAuctionReverseAuctionBundle:UserInfo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserInfo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:UserInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserInfo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ReverseAuctionReverseAuctionBundle:UserInfo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserInfo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:UserInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserInfo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ReverseAuctionReverseAuctionBundle:UserInfo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserInfo entity.
    *
    * @param UserInfo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserInfo $entity)
    {
        $form = $this->createForm(new UserInfoType(), $entity, array(
            'action' => $this->generateUrl('userinfo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserInfo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:UserInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserInfo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('userinfo_edit', array('id' => $id)));
        }

        return $this->render('ReverseAuctionReverseAuctionBundle:UserInfo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserInfo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ReverseAuctionReverseAuctionBundle:UserInfo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserInfo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('userinfo'));
    }

    /**
     * Creates a form to delete a UserInfo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userinfo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
