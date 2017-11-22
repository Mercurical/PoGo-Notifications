<?php

namespace AppBundle\Entity;

class Pokemon
{
    /**
     * @var \DateTime
     */
    private $expiresAt;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lon;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $pokemonId;

    /**
     * @var int
     */
    private $timestamp;

    /**
     * @var bool
     */
    private $trash;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->createFromArray($data);
        }
    }

    private function createFromArray(array $data)
    {
        $date = new \DateTime();
        $date->setTimestamp((int)$data['expires_at']);
        $this->setExpiresAt($date);
        $this->setId($data['id']);
        $this->setLat($data['lat']);
        $this->setLon($data['lon']);
        $this->setName($data['name']);
        $this->setPokemonId($data['pokemon_id']);
        $this->setTrash($data['trash'] == "true" ? true : false);
        $this->setTimestamp((int)$data['expires_at']);
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getFormattedExpiredAt($format = "Y-m-d H:i:s")
    {
        return $this->expiresAt->format($format);
    }

    /**
     * @return string
     */
    public function getTimeToExpire()
    {
        $current = new \DateTime();

        $diff = $current->diff($this->expiresAt);

        return $diff->i . 'm ' . $diff->s . 's';
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     */
    public function setLat(string $lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return string
     */
    public function getLon(): string
    {
        return $this->lon;
    }

    /**
     * @param string $lon
     */
    public function setLon(string $lon)
    {
        $this->lon = $lon;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPokemonId(): int
    {
        return $this->pokemonId;
    }

    /**
     * @param int $pokemonId
     */
    public function setPokemonId(int $pokemonId)
    {
        $this->pokemonId = $pokemonId;
    }

    /**
     * @return boolean
     */
    public function isTrash(): bool
    {
        return $this->trash;
    }

    /**
     * @param boolean $trash
     */
    public function setTrash(bool $trash)
    {
        $this->trash = $trash;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }
}