<?php

namespace EcommerceBundle\Entity;

use EcommerceBundle\Entity\ServiceRange;
use EcommerceBundle\Entity\CustomerGroup;
use EcommerceBundle\Entity\PriceCurrency;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Service
 *
 * @ORM\Table(name="headoo_ecommerce_service")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Entity\ServiceRepository")
 */
class Service
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     *
     * @Assert\Length(
     *     max=10,
     *     maxMessage="The price is too long."
     * )
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="PriceCurrency")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $priceCurrency;
    
    /**
     * @ORM\ManyToOne(targetEntity="CustomerGroup")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $customerGroup;
    
    /**
     * @ORM\ManyToOne(targetEntity="ServiceRange", inversedBy="services")
     * @ORM\JoinColumn(name="service_range_id", referencedColumnName="id", nullable=true)
     */
    protected $serviceRange;
    
    public function __toString()
    {
        return (string)$this->id;
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
     * Set price
     *
     * @param string $price
     *
     * @return Service
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceCurrency
     *
     * $priceCurrency
     *
     * @return Service
     */
    public function setPriceCurrency($priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * Get priceCurrency
     *
     * @return $priceCurrency
     */
    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }
    
    /**
     * Set customerGroup
     *
     * $customerGroup
     *
     * @return Service
     */
    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = $customerGroup;
    }

    /**
     * Get customerGroup
     *
     * @return $customerGroup
     */
    public function getCustomerGroup()
    {
        return $this->customerGroup;
    }
    
    /**
     * Set serviceRange
     *
     * $serviceRange
     *
     * @return Service
     */
    public function setServiceRange(ServiceRange $serviceRange)
    {
        $this->serviceRange = $serviceRange;
    }

    /**
     * Get serviceRange
     *
     * @return $serviceRange
     */
    public function getServiceRange()
    {
        return $this->serviceRange;
    }
}
