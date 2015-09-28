<?php

namespace EcommerceBundle\Entity;

use EcommerceBundle\Entity\Service;
use EcommerceBundle\Entity\Order;
use Doctrine\ORM\Mapping as ORM;

/**
 * OrderedItem
 *
 * @ORM\Table(name="headoo_ecommerce_ordereditem")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Entity\OrderedItemRepository")
 */
class OrderedItem 
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $service;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;
    
    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="orderedItems")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    protected $order;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set service
     *
     * $service
     *
     * @return OrderedItem
     */
    public function setService(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get service
     *
     * @return $service
     */
    public function getService()
    {
        return $this->service;
    }
    
    /**
     * Set quantity
     *
     * @var integer
     *
     * @return OrderedItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    /**
     * Set order
     *
     * Order $order
     *
     * @return OrderedItem
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get order
     *
     * @return Order $order
     */
    public function getOrder()
    {
        return $this->order;
    }

}
