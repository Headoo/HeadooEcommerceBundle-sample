<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * PaymentMethod controller.
 *
 */
class PaymentMethodController extends Controller
{
    
    private $class;
    
    protected function getClass()
    {
        $this->class = $this->container->getParameter('headoo_ecommerce.paymentmethod.class');
        return $this->class;
    }

    /**
     * Lists all PaymentMethod entities.
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
     * Creates a new PaymentMethod entity.
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

            return $this->redirect($this->generateUrl('hecommerce_paymentmethod_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PaymentMethod entity.
     *
     * @param PaymentMethod $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm($entity)
    {
        $submitTranslation = $this->get('translator')->trans('hecommerce.management.create', array(), 'management');
        
        $form = $this->createForm('headoo_ecommercebundle_paymentmethod', $entity, array(
            'action' => $this->generateUrl('hecommerce_paymentmethod_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $submitTranslation));

        return $form;
    }

    /**
     * Displays a form to create a new PaymentMethod entity.
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
     * Finds and displays a PaymentMethod entity.
     *
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getClass())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PaymentMethod entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getClass())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
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
    * Creates a form to edit a PaymentMethod entity.
    *
    * @param PaymentMethod $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm($entity)
    {
        $submitTranslation = $this->get('translator')->trans('hecommerce.management.edit', array(), 'management');
        
        $form = $this->createForm('headoo_ecommercebundle_paymentmethod', $entity, array(
            'action' => $this->generateUrl('hecommerce_paymentmethod_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => $submitTranslation));

        return $form;
    }
    
    /**
     * Edits an existing PaymentMethod entity.
     *
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository($this->getClass())->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('hecommerce_paymentmethod_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Deletes a PaymentMethod entity.
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
                throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('hecommerce_paymentmethod'));
    }

    /**
     * Creates a form to delete a PaymentMethod entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        $submitTranslation = $this->get('translator')->trans('hecommerce.management.delete', array(), 'management');
        
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hecommerce_paymentmethod_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => $submitTranslation))
            ->getForm()
        ;
    }
}
