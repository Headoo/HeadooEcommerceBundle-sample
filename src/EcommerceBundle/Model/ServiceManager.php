<?php
    
namespace EcommerceBundle\Model;

use EcommerceBundle\Model\BaseManager;
use Doctrine\ORM\EntityManager;

class ServiceManager extends BaseManager
{
    /**
     * Load the services related to a customer group and the price currency of the user.
     *
     */
    public function loadByCustomerGroupAndPriceCurrency($customerGroup, $priceCurrency)
    {
        return $this->getRepository()->findByCustomerGroupAndPriceCurrency($customerGroup, $priceCurrency);
    }
}
