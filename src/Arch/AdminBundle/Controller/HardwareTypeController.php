<?php

namespace Arch\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arch\AdminBundle\Entity\HardwareType;
use Arch\AdminBundle\Form\HardwareTypeType;

/**
 * HardwareType controller.
 *
 * @Route("/hardwaretype")
 */
class HardwareTypeController extends Controller
{
    /**
     * Lists all HardwareType entities.
     *
     * @Route("/", name="hardwaretype")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ArchAdminBundle:HardwareType')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a HardwareType entity.
     *
     * @Route("/{id}/show", name="hardwaretype_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:HardwareType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HardwareType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new HardwareType entity.
     *
     * @Route("/new", name="hardwaretype_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new HardwareType();
        $form   = $this->createForm(new HardwareTypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new HardwareType entity.
     *
     * @Route("/create", name="hardwaretype_create")
     * @Method("post")
     * @Template("ArchAdminBundle:HardwareType:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new HardwareType();
        $request = $this->getRequest();
        $form    = $this->createForm(new HardwareTypeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hardwaretype_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing HardwareType entity.
     *
     * @Route("/{id}/edit", name="hardwaretype_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:HardwareType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HardwareType entity.');
        }

        $editForm = $this->createForm(new HardwareTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing HardwareType entity.
     *
     * @Route("/{id}/update", name="hardwaretype_update")
     * @Method("post")
     * @Template("ArchAdminBundle:HardwareType:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:HardwareType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HardwareType entity.');
        }

        $editForm   = $this->createForm(new HardwareTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hardwaretype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a HardwareType entity.
     *
     * @Route("/{id}/delete", name="hardwaretype_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ArchAdminBundle:HardwareType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find HardwareType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('hardwaretype'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
