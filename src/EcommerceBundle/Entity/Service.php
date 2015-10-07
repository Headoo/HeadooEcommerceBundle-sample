<?php

namespace EcommerceBundle\Entity;

use EcommerceBundle\Entity\ServiceRange;
use EcommerceBundle\Entity\CustomerGroup;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Service
 *
 * @ORM\Table(name="headoo_ecommerce_service")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Entity\ServiceRepository")
 *
 * @Gedmo\TranslationEntity(class="EcommerceBundle\Entity\Translation\ServiceTranslation")
 */
class Service implements Translatable
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
     * @Gedmo\Translatable
     *
     * @ORM\Column(name="name", type="string", length=50)
     *
     * @Assert\Length(
     *     max=50,
     *     maxMessage="The name is too long."
     * )
     */
    protected $name;
    
    /**
     * @var string
     *
     * @Gedmo\Translatable
     *
     * @ORM\Column(name="description", type="text")
     *
     * @Assert\Length(
     *     max=500,
     *     maxMessage="The name is too long."
     * )
     */
    protected $description;
    
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

    /**
     * Post locale
     * Used locale to override Translation listener's locale
     *
     * @Gedmo\Locale
     */
    protected $locale;
    
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
     * Set name
     *
     * @param string $name
     *
     * @return Service
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
     * Set description
     *
     * @param text $description
     *
     * @return Service
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
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

    /**
     * Set translatable locale
     *
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}
