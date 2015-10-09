<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Controller\GenericController;

/**
 * PaymentMethod controller.
 *
 */
class PaymentMethodController extends GenericController
{
    public function __construct()
    {
        parent::__construct('headoo_ecommerce.paymentmethod.entity', 'PaymentMethod');
    }
}
