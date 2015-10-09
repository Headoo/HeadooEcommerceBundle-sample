<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Controller\GenericController;

/**
 * ServiceRange controller.
 *
 */
class ServiceRangeController extends GenericController
{
    public function __construct()
    {
        parent::__construct('headoo_ecommerce.servicerange.entity', 'ServiceRange');
    }
}
