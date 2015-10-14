<?php

namespace EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
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
}
