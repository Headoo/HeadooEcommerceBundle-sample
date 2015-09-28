<?php

namespace EcommerceBundle\Entity;

use EcommerceBundle\Entity\Order;
use Doctrine\ORM\Mapping as ORM;

/**
 * Confirmation Email
 *
 * @ORM\Table(name="headoo_ecommerce_confirmationemail")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Entity\ConfirmationEmailRepository")
 */
class ConfirmationEmail 
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
     * @ORM\OneToOne(targetEntity="Order")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $order;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_at", type="datetime", nullable=true)
     */
    private $sentAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="send_at", type="datetime", nullable=true)
     */
    private $sendAt;

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
     * Set order
     *
     * $order
     *
     * @return ConfirmationEmail
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get order
     *
     * @return $order
     */
    public function getOrder()
    {
        return $this->order;
    }
        
    /**
     * Set sentAt
     *
     * @param \DateTime $sentAt
     * @return ConfirmationEmail
     */
    public function setSentAt($datetime = null)
    {
        if ($datetime == null)
        {
            $this->sentAt = date_create(date('Y-m-d H:i:s'));
            $this->sendAt = null;

        }
        else
        {
            $this->sentAt = $datetime;
        }
    }

    /**
     * Get sentAt
     *
     * @return \DateTime 
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * Set sendAt
     *
     * @param \DateTime $sendAt
     * @return ConfirmationEmail
     */
    public function setSendAt($datetime = null)
    {
        if ($datetime == null)
        {
            $this->sendAt = date_create(date('Y-m-d H:i:s'));
        }
        else
        {
            $this->sendAt = $datetime;
        }
    }

    /**
     * Get sendAt
     *
     * @return \DateTime 
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }
    
}
