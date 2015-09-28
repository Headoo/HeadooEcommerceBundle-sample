<?php
    
namespace EcommerceBundle\Model;

use EcommerceBundle\Model\BaseManager;

class OrderedItemManager extends BaseManager
{
    /**
     * Load ordered items that are part of the same order.
     *
     */
    public function loadByOrder($order) 
    {
        return $this->getRepository()->findByOrder($order);
    }
    
    /**
     * Load the ordered item that is part of a specific order and related to a specific service.
     *
     */
    public function loadByServiceAndOrder($service, $order) 
    {
        return $this->getRepository()->findByServiceAndOrder($service, $order);
    }
    
}
