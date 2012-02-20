<?php

namespace Arch\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arch\AdminBundle\Entity\SoftwareType;
use Arch\AdminBundle\Form\SoftwareTypeType;

/**
 * SoftwareType controller.
 *
 * @Route("/softwaretype")
 */
class SoftwareTypeController extends Controller
{
    /**
     * Lists all SoftwareType entities.
     *
     * @Route("/", name="softwaretype")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ArchAdminBundle:SoftwareType')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a SoftwareType entity.
     *
     * @Route("/{id}/show", name="softwaretype_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:SoftwareType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SoftwareType entity.');
        }

        $software = $em->getRepository('ArchAdminBundle:Software')->findBySoftwareType($entity->getId());

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'software'      => $software,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new SoftwareType entity.
     *
     * @Route("/new", name="softwaretype_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SoftwareType();
        $form   = $this->createForm(new SoftwareTypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new SoftwareType entity.
     *
     * @Route("/create", name="softwaretype_create")
     * @Method("post")
     * @Template("ArchAdminBundle:SoftwareType:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new SoftwareType();
        $request = $this->getRequest();
        $form    = $this->createForm(new SoftwareTypeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('softwaretype_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing SoftwareType entity.
     *
     * @Route("/{id}/edit", name="softwaretype_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:SoftwareType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SoftwareType entity.');
        }

        $editForm = $this->createForm(new SoftwareTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing SoftwareType entity.
     *
     * @Route("/{id}/update", name="softwaretype_update")
     * @Method("post")
     * @Template("ArchAdminBundle:SoftwareType:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:SoftwareType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SoftwareType entity.');
        }

        $editForm   = $this->createForm(new SoftwareTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('softwaretype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a SoftwareType entity.
     *
     * @Route("/{id}/delete", name="softwaretype_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ArchAdminBundle:SoftwareType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SoftwareType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('softwaretype'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
