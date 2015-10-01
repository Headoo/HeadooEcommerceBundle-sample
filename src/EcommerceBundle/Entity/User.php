<?php

namespace EcommerceBundle\Entity;

use EcommerceBundle\Entity\CustomerGroup;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * This class extends the FOSUserBundle User class
 *
 * @ORM\Table(name="headoo_ecommerce_user")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage="The first name is too short.",
     *     maxMessage="The first name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage="The last name is too short.",
     *     maxMessage="The last name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     *
     * @Assert\MaxLength(15)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=200, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter your address.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=200,
     *     minMessage="The address is too short.",
     *     maxMessage="The address is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=15, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter your zip code.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=15,
     *     minMessage="The zip code is too short.",
     *     maxMessage="The zip code is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=60, nullable=true)
     *
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage="The city is too short.",
     *     maxMessage="The city is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=50, nullable=true)
     *
     * @Assert\Country
     * @Assert\NotBlank(message="Please enter your country.", groups={"Registration", "Profile"})
     */
    protected $country;

    /**
     * @ORM\ManyToOne(targetEntity="CustomerGroup")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $customerGroup;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return User
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set customerGroup
     *
     * @param string $customerGroup
     *
     * @return CustomerGroup
     */
    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = $customerGroup;
    }

    /**
     * Get customerGroup
     *
     * @return string
     */
    public function getCustomerGroup()
    {
        return $this->customerGroup;
    }

}
