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
     * @var int
     */
    private $attack = 0;

    /**
     * @var int
     */
    private $defense = 0;

    /**
     * @var int
     */
    private $stamina = 0;

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

        if (array_key_exists('atk', $data)) {
            $this->setAttack($data['atk']);
            $this->setDefense($data['def']);
            $this->setStamina($data['sta']);
        }
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

    /**
     * @return int
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /**
     * @param int $attack
     */
    public function setAttack(int $attack)
    {
        $this->attack = $attack;
    }

    /**
     * @return int
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * @param int $defense
     */
    public function setDefense(int $defense)
    {
        $this->defense = $defense;
    }

    /**
     * @return int
     */
    public function getStamina(): int
    {
        return $this->stamina;
    }

    /**
     * @param int $stamina
     */
    public function setStamina(int $stamina)
    {
        $this->stamina = $stamina;
    }

    /**
     * @return bool
     */
    public function hasIV(): bool
    {
        return ($this->attack + $this->defense + $this->stamina) > 0;
    }

    /**
     * @return string
     */
    public function getIV(): string
    {
        return number_format(($this->attack + $this->defense + $this->stamina) / 45 * 100, 2);
    }
}