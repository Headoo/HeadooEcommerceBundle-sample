<?php

namespace EcommerceBundle\Entity;

use EcommerceBundle\Entity\PriceCurrency;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CustomerGroup
 *
 * @ORM\Table(name="headoo_ecommerce_customer_group")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Entity\CustomerGroupRepository")
 */
class CustomerGroup
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     *
     * @Assert\MaxLength(30)
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="PriceCurrency")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $priceCurrency;

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
     * Set name
     *
     * @param string $name
     *
     * @return CustomerGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set priceCurrency
     *
     * PriceCurrency $priceCurrency
     *
     * @return CustomerGroup
     */
    public function setPriceCurrency(PriceCurrency $priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * Get priceCurrency
     *
     * @return PriceCurrency $priceCurrency
     */
    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }

}
