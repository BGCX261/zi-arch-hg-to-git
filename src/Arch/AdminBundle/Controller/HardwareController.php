<?php

namespace Arch\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arch\AdminBundle\Entity\Hardware;
use Arch\AdminBundle\Form\HardwareType;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Hardware controller.
 *
 * @Route("/hardware")
 */
class HardwareController extends Controller
{
    /**
     * Lists all Hardware entities.
     *
     * @Route("/", name="hardware")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ArchAdminBundle:Hardware')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Hardware entity.
     *
     * @Route("/{id}/show", name="hardware_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Hardware')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hardware entity.');
        }

        $devices = $em->getRepository('ArchAdminBundle:Device')->findByHardware($entity->getId());

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'devices'     => $devices,
        );
    }

    /**
     * Displays a form to create a new Hardware entity.
     *
     * @Route("/new", name="hardware_new")
     * @Template()
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new Hardware();
        $form   = $this->createForm(new HardwareType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Hardware entity.
     *
     * @Route("/create", name="hardware_create")
     * @Method("post")
     * @Template("ArchAdminBundle:Hardware:new.html.twig")
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction()
    {
        $entity  = new Hardware();
        $request = $this->getRequest();
        $form    = $this->createForm(new HardwareType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hardware_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Hardware entity.
     *
     * @Route("/{id}/edit", name="hardware_edit")
     * @Template()
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Hardware')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hardware entity.');
        }

        $editForm = $this->createForm(new HardwareType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Hardware entity.
     *
     * @Route("/{id}/update", name="hardware_update")
     * @Method("post")
     * @Template("ArchAdminBundle:Hardware:edit.html.twig")
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Hardware')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hardware entity.');
        }

        $editForm   = $this->createForm(new HardwareType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hardware_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Hardware entity.
     *
     * @Route("/{id}/delete", name="hardware_delete")
     * @Method("post")
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ArchAdminBundle:Hardware')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Hardware entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('hardware'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
