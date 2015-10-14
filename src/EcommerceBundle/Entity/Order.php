<?php

namespace EcommerceBundle\Entity;

use EcommerceBundle\Entity\PaymentMethod;
use EcommerceBundle\Entity\Payment;
use EcommerceBundle\Entity\OrderedItem;
use EcommerceBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Order
 *
 * @ORM\Table(name="headoo_ecommerce_order")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Entity\OrderRepository")
 */
class Order 
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $user;
    
    /**
     * @var totalPaymentDue
     *
     * @ORM\Column(name="total_payment_due", type="integer", nullable=false)
     */
    protected $totalPaymentDue;
    
    /**
     * @var orderDate
     *
     * @ORM\Column(name="order_date", type="date", nullable=false)
     */
    protected $orderDate;
    
    /**
     * @ORM\ManyToOne(targetEntity="PaymentMethod")
     * @ORM\JoinColumn(nullable=true)
     *
     * If paymentMethod is empty, this means that the client abandonned the order before payment.
     */
    protected $paymentMethod;
    
    /**
     * @ORM\ManyToOne(targetEntity="Payment")
     * @ORM\JoinColumn(nullable=true)
     *
     * This property stocks a Payum Payment Entity.
     */
    protected $paymentDetails;
        
    /**
     * @var scheduledPaymentDate
     *
     * @ORM\Column(name="schedule_payment_date", type="date", nullable=false)
     */
    protected $scheduledPaymentDate;
    
    /**
     * @var paymentDate
     *
     * @ORM\Column(name="payment_date", type="date", nullable=true)
     */
    protected $paymentDate;
    
    /**
     * @ORM\OneToMany(targetEntity="OrderedItem", mappedBy="order", cascade={"persist", "remove"})
     *
     */
    private $orderedItems;
    
    public function __toString()
    {
        return (string)$this->id;
    }  
    
    public function __construct() {
        $this->orderedItems = new ArrayCollection();
    }
       
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
     * Set user
     *
     * $user
     *
     * @return Order
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return $user
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Set totalPaymentDue
     *
     * $totalPaymentDue
     *
     * @return Order
     */
    public function setTotalPaymentDue($totalPaymentDue)
    {
        $this->totalPaymentDue = $totalPaymentDue;
    }

    /**
     * Get totalPaymentDue
     *
     * @return $totalPaymentDue
     */
    public function getTotalPaymentDue()
    {
        return $this->totalPaymentDue;
    }
    
    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     *
     * @return Order
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * Get orderDate
     *
     * @return datetime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }
    
    /**
     * Set paymentMethod
     *
     * PaymentMethod $paymentMethod
     *
     * @return Order
     */
    public function setPaymentMethod(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Get paymentMethod
     *
     * @return PaymentMethod $paymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
    
    /**
     * Set paymentDetails
     *
     * Payment $paymentDetails
     *
     * @return Order
     */
    public function setPaymentDetails(Payment $paymentDetails)
    {
        $this->paymentDetails = $paymentDetails;
    }

    /**
     * Get paymentDetails
     *
     * @return PaymentDetails $paymentDetails
     */
    public function getPaymentDetails()
    {
        return $this->paymentDetails;
    }
        
    /**
     * Set scheduledPaymentDate
     *
     * @param \DateTime $scheduledPaymentDate
     *
     * @return Order
     */
    public function setScheduledPaymentDate($scheduledPaymentDate)
    {
        $this->scheduledPaymentDate = $scheduledPaymentDate;
    }

    /**
     * Get scheduledPaymentDate
     *
     * @return datetime
     */
    public function getScheduledPaymentDate()
    {
        return $this->scheduledPaymentDate;
    }
    
    /**
     * Set paymentDate
     *
     * @param \DateTime $paymentDate
     *
     * @return Order
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;
    }

    /**
     * Get paymentDate
     *
     * @return datetime
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Get orderedItems
     *
     * @return OrderedItem
     */
    public function getOrderedItems()
    {
        return $this->orderedItems;
    }
}
