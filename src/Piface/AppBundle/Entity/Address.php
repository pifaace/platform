<?php

namespace Piface\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="platform_address")
 * @ORM\Entity(repositoryClass="Piface\AppBundle\Repository\AddressRepository")
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="additionalAddress", type="string", length=255, nullable=true)
     */
    private $additionalAddress;

    /**
     * @Assert\NotBlank()
     *
     * @var string
     *
     * @ORM\Column(name="postalCode", type="string", length=255)
     */
    private $postalCode;

    /**
     * @Assert\NotBlank()
     *
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=255)
     */
    private $town;


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
     * Set address
     *
     * @param string $address
     * @return Address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
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
     * Set additionalAddress
     *
     * @param string $additionalAddress
     * @return Address
     */
    public function setAdditionalAddress($additionalAddress)
    {
        $this->additionalAddress = $additionalAddress;

        return $this;
    }

    /**
     * Get additionalAddress
     *
     * @return string
     */
    public function getAdditionalAddress()
    {
        return $this->additionalAddress;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return Address
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }
}
