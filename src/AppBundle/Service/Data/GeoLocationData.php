<?php

namespace AppBundle\Service\Data;

use AppBundle\Entity\Pokemon;
use AppBundle\Service\Transformer\GeoLocationDataTransformer;

class GeoLocationData
{
    /**
     * @var GeoLocationDataTransformer
     */
    private $transformer;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * GeoLocationData constructor.
     * @param GeoLocationDataTransformer $transformer
     * @param string $apiUrl
     * @param string $apiKey
     */
    public function __construct(GeoLocationDataTransformer $transformer, string $apiUrl, string $apiKey)
    {
        $this->transformer = $transformer;
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
    }

    public function getData(Pokemon $pokemon)
    {
        $curl = curl_init(
            $this->apiUrl . 'latlng=' . $pokemon->getLat() . ',' . $pokemon->getLon().'&key=' . $this->apiKey
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        if (null === $result) {
            throw new \Exception("An error occured during getting geolocation data.");
        }

        return $this->transformer->transform($result);
    }
}