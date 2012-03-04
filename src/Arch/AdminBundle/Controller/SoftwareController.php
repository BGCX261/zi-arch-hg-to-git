<?php

namespace Arch\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arch\AdminBundle\Entity\Software;
use Arch\AdminBundle\Form\SoftwareType;

/**
 * Software controller.
 *
 * @Route("/software")
 */
class SoftwareController extends Controller
{
    /**
     * Lists all Software entities.
     *
     * @Route("/", name="software")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ArchAdminBundle:Software')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Software entity.
     *
     * @Route("/{id}/show", name="software_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Software')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Software entity.');
        }

        $devices = $em->getRepository('ArchAdminBundle:Device')->findBySoftware($entity->getId());

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'devices'     => $devices,
        );
    }

    /**
     * Displays a form to create a new Software entity.
     *
     * @Route("/new", name="software_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Software();
        $form   = $this->createForm(new SoftwareType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Software entity.
     *
     * @Route("/create", name="software_create")
     * @Method("post")
     * @Template("ArchAdminBundle:Software:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Software();
        $request = $this->getRequest();
        $form    = $this->createForm(new SoftwareType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('software_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Software entity.
     *
     * @Route("/{id}/edit", name="software_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Software')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Software entity.');
        }

        $editForm = $this->createForm(new SoftwareType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Software entity.
     *
     * @Route("/{id}/update", name="software_update")
     * @Method("post")
     * @Template("ArchAdminBundle:Software:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:Software')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Software entity.');
        }

        $editForm   = $this->createForm(new SoftwareType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('software_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Software entity.
     *
     * @Route("/{id}/delete", name="software_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ArchAdminBundle:Software')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Software entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('software'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
