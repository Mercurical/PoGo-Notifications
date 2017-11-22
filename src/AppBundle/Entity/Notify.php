<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Notify
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="notify")
 */
class Notify
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="opt_key", type="string", length=100)
     */
    private $key;

    /**
     * @var string
     * @ORM\Column(name="opt_val", type="text")
     */
    private $val;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getVal()
    {
        return $this->val;
    }

    /**
     * @param string $val
     */
    public function setVal($val)
    {
        $this->val = $val;
    }
}