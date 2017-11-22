<?php

namespace AppBundle\Service\Data;

use AppBundle\Entity\Pokemon;
use AppBundle\Service\Transformer\PokemonDataTransformer;

class PokemonData
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var PokemonDataTransformer
     */
    private $transformer;

    /**
     * PokemonData constructor.
     * @param PokemonDataTransformer $transformer
     * @param string $endpoint
     */
    public function __construct(PokemonDataTransformer $transformer, string $endpoint)
    {
        $this->transformer = $transformer;
        $this->endpoint = $endpoint;
    }

    /**
     * @param string $lastID
     * @return Pokemon[]
     */
    public function getData($lastID = '0')
    {
        $curl = curl_init($this->endpoint . '?last_id=' . $lastID);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        return $this->transformer->transform($result);
    }
}