<?php

namespace AppBundle\Service\Transformer;

use AppBundle\Entity\GeoLocation;

class GeoLocationDataTransformer
{
    /**
     * @param string $data
     * @return GeoLocation
     */
    public function transform(string $data): GeoLocation
    {
        $decodedData = json_decode($data, true);

        return new GeoLocation($decodedData);
    }
}