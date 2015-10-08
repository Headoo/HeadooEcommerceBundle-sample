<?php

namespace EcommerceBundle\Entity;

use EcommerceBundle\Entity\ServiceRange;
use EcommerceBundle\Entity\CustomerGroup;
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
     * @ORM\ManyToOne(targetEntity="CustomerGroup")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $customerGroup = 0;
    
    /**
     * @ORM\ManyToOne(targetEntity="ServiceRange")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $serviceRange = 0;
    
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
