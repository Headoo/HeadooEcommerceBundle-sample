<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EcommerceBundle\Controller\GenericController;

/**
 * Order controller.
 *
 */
class OrderController extends GenericController
{
    public function __construct()
    {
        parent::__construct('headoo_ecommerce.order.entity', 'Order');
    }

    /**
     * Deletes an entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        parent::deleteAction($request, $id);

        return $this->redirect($this->generateUrl('hecommerce_store_buy'));
    }


    /**
     * Deletes an Order entity.
     *
     */
    /*public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->em->getRepository($this->class)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Order entity.');
            }

            $this->em->remove($entity);
            $this->em->flush();
        }
		
		return new RedirectResponse($this->router->generate('hecommerce_store_buy'));
    }*/

    /**
     * Creates a form to delete an Order entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    /*public function createDeleteForm($id)
    {   
        $submitTranslation = $this->translator->trans('hecommerce.management.delete', array(), 'management');
        
        return $this->formFactory->createBuilder('form', null, array())
        			->setAction($this->router->generate('hecommerce_order_delete', array('id' => $id)))
		            ->setMethod('DELETE')
		            ->add('submit', 'submit', array('label' => $submitTranslation))
		            ->getForm()
		            ;
    }*/
}
