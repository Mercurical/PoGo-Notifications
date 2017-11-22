<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Configuration
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="configuration")
 */
class Configuration
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="skype_username", type="string", length=100)
     */
    private $skypeUsername;

    /**
     * @var string
     * @ORM\Column(name="pokemon_ids", type="text")
     */
    private $pokemonIDs;

    /**
     * @var boolean
     * @ORM\Column(name="is_used", type="boolean")
     */
    private $isUsed;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="configurations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSkypeUsername()
    {
        return $this->skypeUsername;
    }

    /**
     * @param string $skypeUsername
     */
    public function setSkypeUsername($skypeUsername)
    {
        $this->skypeUsername = $skypeUsername;
    }

    /**
     * @return string
     */
    public function getPokemonIDs()
    {
        return $this->pokemonIDs;
    }

    /**
     * @param string $pokemonIDs
     */
    public function setPokemonIDs($pokemonIDs)
    {
        $this->pokemonIDs = $pokemonIDs;
    }

    /**
     * @return boolean
     */
    public function isIsUsed()
    {
        return $this->isUsed;
    }

    /**
     * @param boolean $isUsed
     */
    public function setIsUsed($isUsed)
    {
        $this->isUsed = $isUsed;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}