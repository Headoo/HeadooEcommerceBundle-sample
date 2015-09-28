<?php
    
namespace EcommerceBundle\Model;

use EcommerceBundle\Model\BaseManager;
use Symfony\Component\DependencyInjection\Container;

class OrderManager extends BaseManager
{     
    protected $em;
    
    protected $entity;
    
    protected $container;

    public function __construct($em, $entity, Container $container)
    {
        parent::__construct($em, $entity);

        $this->container = $container;
    }
    
    /**
     * Creates an empty order instance to be used when orderedItems are created.
     *
     */
    public function create() 
    {
        $currentOrder = $this->loadOrderForConnectedUser();
        
        if ($currentOrder) {
            $order = $currentOrder;
        } else {
            $order = new $this->entity();
            $order->setUser($this->getConnectedUser());
            $order->setTotalPaymentDue(0);
            $order->setOrderDate(new \DateTime());
            //cela doit être la date d'envoi de la facture pour les revendeurs après
            $order->setScheduledPaymentDate(new \DateTime());
            $this->save($order);          
        }

        return $order;
    }
    
    /**
     * Get the current non paid order of the user that is connected (if there is already one). 
     *
     */
    public function loadOrderForConnectedUser() 
    {
        return $this->getRepository()->findOrderForConnectedUser($this->getConnectedUser()->getId());
    }
    
    /**
     * Get the connected user. 
     *
     */
    private function getConnectedUser() 
    {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }
    
}
