<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServiceRange
 *
 * @ORM\Table(name="headoo_ecommerce_servicerange")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Entity\ServiceRangeRepository")
 */
class ServiceRange 
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
     * @ORM\Column(name="name", type="string", length=30)
     *
     * @Assert\Length(
     *     max=30,
     *     maxMessage="The name is too long."
     * )
     */
    protected $name;

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
     * @return ServiceRange
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
}
