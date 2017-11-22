<?php

namespace AppBundle\Service\Transformer;

use AppBundle\Entity\Pokemon;

class PokemonDataTransformer
{
    /**
     * @param string $data
     * @return array
     */
    public function transform(string $data): array
    {
        $decodedData = json_decode($data, true);
        $collection = [];

        foreach ($decodedData as $item) {
            $collection[] = new Pokemon($item);
        }

        return $collection;
    }
}