<?php

namespace Piface\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Piface\AppBundle\Entity\Advert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="platform_user")
 * @ORM\Entity(repositoryClass="Piface\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank()
     */
    protected $firstName;

    /**
     * @ORM\Column(name="birthday", type="datetime", nullable=false)
     *
     */
    protected $birthday;

    /**
     * @var string
     * @ORM\Column(name="sexe", type="string", nullable=false)
     *
     */
    protected $sexe;


    /**
     * @ORM\ManyToMany(targetEntity="Piface\AppBundle\Entity\Advert")
     * @ORM\JoinColumn=(nullable=true)
     */
    protected $advsSave;

    public function __construct()
    {
        $this->advsSave = new ArrayCollection();
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * Add advsSave
     *
     * @param Advert $advsSave
     * @return User
     */
    public function addAdvsSave(Advert $advsSave)
    {
        $this->advsSave[] = $advsSave;

        return $this;
    }

    /**
     * Remove advsSave
     *
     * @param Advert $advsSave
     */
    public function removeAdvsSave(Advert $advsSave)
    {
        $this->advsSave->removeElement($advsSave);
    }

    /**
     * Get advsSave
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdvsSave()
    {
        return $this->advsSave;
    }
}
