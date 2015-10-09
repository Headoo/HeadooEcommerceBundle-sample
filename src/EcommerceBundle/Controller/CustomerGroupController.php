<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Controller\GenericController;

/**
 * CustomerGroup controller.
 *
 */
class CustomerGroupController extends GenericController
{
    public function __construct()
    {
        parent::__construct('headoo_ecommerce.customergroup.entity', 'CustomerGroup');
    }
}
