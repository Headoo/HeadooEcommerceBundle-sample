<?php
    
namespace EcommerceBundle\Model;

use EcommerceBundle\Model\BaseManager;
use Doctrine\ORM\EntityManager;

class ServiceManager extends BaseManager
{
    /**
     * Load the services related to a customer group.
     *
     */
    public function loadByCustomerGroup($customerGroup) 
    {
        return $this->getRepository()->findByCustomerGroup($customerGroup);
    }
}
