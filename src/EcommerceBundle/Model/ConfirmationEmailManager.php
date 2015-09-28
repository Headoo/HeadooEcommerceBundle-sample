<?php
    
namespace EcommerceBundle\Model;

use EcommerceBundle\Model\BaseManager;
use Symfony\Component\DependencyInjection\Container;

class ConfirmationEmailManager extends BaseManager
{     
    /**
     * Find the confirmation emails that are not yet sent. 
     *
     */
    public function loadBySentDate() 
    {
        return $this->getRepository()->findBySentDate();
    }
}
