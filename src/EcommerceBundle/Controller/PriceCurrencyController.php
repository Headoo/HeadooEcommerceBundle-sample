<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * PriceCurrency controller.
 *
 */
class PriceCurrencyController extends Controller
{
    
    private $class;
    
    protected function getClass()
    {
        $this->class = $this->container->getParameter('headoo_ecommerce.pricecurrency.entity');
        return $this->class;
    }

    /**
     * Lists all PriceCurrency entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository($this->getClass())->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Creates a new PriceCurrency entity.
     *
     * @Template()
     */
    public function createAction(Request $request)
    {
        $class= $this->getClass();
        $entity = new $class;
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hecommerce_pricecurrency_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PriceCurrency entity.
     *
     * @param CustomerGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm($entity)
    {
        $submitTranslation = $this->get('translator')->trans('hecommerce.management.create', array(), 'management');
        
        $form = $this->createForm('headoo_ecommercebundle_pricecurrency', $entity, array(
            'action' => $this->generateUrl('hecommerce_pricecurrency_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $submitTranslation));

        return $form;
    }

    /**
     * Displays a form to create a new PriceCurrency entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $class= $this->getClass();
        $entity = new $class;
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PriceCurrency entity.
     *
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getClass())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PriceCurrency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PriceCurrency entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getClass())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PriceCurrency entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a PriceCurrency entity.
    *
    * @param PriceCurrency $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm($entity)
    {
        $submitTranslation = $this->get('translator')->trans('hecommerce.management.edit', array(), 'management');
        
        $form = $this->createForm('headoo_ecommercebundle_pricecurrency', $entity, array(
            'action' => $this->generateUrl('hecommerce_pricecurrency_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => $submitTranslation));

        return $form;
    }
    
    /**
     * Edits an existing PriceCurrency entity.
     *
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getClass())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PriceCurrency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('hecommerce_pricecurrency_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Deletes a PriceCurrency entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository($this->getClass())->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PriceCurrency entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('hecommerce_pricecurrency'));
    }

    /**
     * Creates a form to delete a PriceCurrency entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        $submitTranslation = $this->get('translator')->trans('hecommerce.management.delete', array(), 'management');
        
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hecommerce_pricecurrency_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => $submitTranslation))
            ->getForm()
        ;
    }
}
