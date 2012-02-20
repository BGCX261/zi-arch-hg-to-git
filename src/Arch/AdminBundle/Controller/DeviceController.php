<?php

namespace Arch\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arch\AdminBundle\Entity\Device;
use Arch\AdminBundle\Form\DeviceType;

/**
 * Device controller.
 *
 * @Route("/device")
 */
class DeviceController extends Controller
{
    /**
     * Lists all Device entities.
     *
     * @Route("/", name="device")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ArchAdminBundle:Device')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Device entity.
     *
     * @Route("/{id}/show", name="device_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Device')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Device entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Device entity.
     *
     * @Route("/new", name="device_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Device();
        $form   = $this->createForm(new DeviceType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Device entity.
     *
     * @Route("/create", name="device_create")
     * @Method("post")
     * @Template("ArchAdminBundle:Device:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Device();
        $request = $this->getRequest();
        $form    = $this->createForm(new DeviceType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('device_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Device entity.
     *
     * @Route("/{id}/edit", name="device_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Device')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Device entity.');
        }

        $editForm = $this->createForm(new DeviceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Device entity.
     *
     * @Route("/{id}/update", name="device_update")
     * @Method("post")
     * @Template("ArchAdminBundle:Device:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Device')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Device entity.');
        }

        $editForm   = $this->createForm(new DeviceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('device_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Device entity.
     *
     * @Route("/{id}/delete", name="device_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ArchAdminBundle:Device')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Device entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('device'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
