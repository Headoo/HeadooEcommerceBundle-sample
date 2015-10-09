<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Controller\GenericController;

/**
 * Service controller.
 *
 */
class ServiceController extends GenericController
{
    public function __construct()
    {
        parent::__construct('headoo_ecommerce.service.entity', 'Service');
    }
}
