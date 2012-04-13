<?php

namespace Arch\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arch\AdminBundle\Entity\License;
use Arch\AdminBundle\Form\LicenseType;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * License controller.
 *
 * @Route("/license")
 */
class LicenseController extends Controller
{
    /**
     * Lists all License entities.
     *
     * @Route("/", name="license")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ArchAdminBundle:License')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a License entity.
     *
     * @Route("/{id}/show", name="license_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:License')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find License entity.');
        }
        $software = $em->getRepository('ArchAdminBundle:Software')->findByLicense($entity->getId());
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'software'    => $software,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new License entity.
     *
     * @Route("/new", name="license_new")
     * @Template()
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new License();
        $form   = $this->createForm(new LicenseType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new License entity.
     *
     * @Route("/create", name="license_create")
     * @Method("post")
     * @Template("ArchAdminBundle:License:new.html.twig")
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction()
    {
        $entity  = new License();
        $request = $this->getRequest();
        $form    = $this->createForm(new LicenseType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('license_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing License entity.
     *
     * @Route("/{id}/edit", name="license_edit")
     * @Template()
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:License')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find License entity.');
        }

        $editForm = $this->createForm(new LicenseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing License entity.
     *
     * @Route("/{id}/update", name="license_update")
     * @Method("post")
     * @Template("ArchAdminBundle:License:edit.html.twig")
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ArchAdminBundle:License')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find License entity.');
        }

        $editForm   = $this->createForm(new LicenseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('license_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a License entity.
     *
     * @Route("/{id}/delete", name="license_delete")
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
            $entity = $em->getRepository('ArchAdminBundle:License')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find License entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('license'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
