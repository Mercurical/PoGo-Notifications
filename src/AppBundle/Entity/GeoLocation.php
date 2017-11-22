<?php

namespace AppBundle\Entity;

class GeoLocation
{
    /**
     * @var string
     */
    private $shortStreetNumber;

    /**
     * @var string
     */
    private $longStreetNumber;

    /**
     * @var string
     */
    private $shortRouteName;

    /**
     * @var string
     */
    private $longRouteName;

    /**
     * @var string
     */
    private $shortLocalityName;

    /**
     * @var string
     */
    private $longLocalityName;

    /**
     * @var string
     */
    private $shortAdministrativeArea2;

    /**
     * @var string
     */
    private $longAdministrativeArea2;

    /**
     * @var string
     */
    private $shortAdministrativeArea1;

    /**
     * @var string
     */
    private $longAdministrativeArea1;

    /**
     * @var string
     */
    private $shortCountry;

    /**
     * @var string
     */
    private $longCountry;

    /**
     * @var string
     */
    private $shortPostalCode;

    /**
     * @var string
     */
    private $longPostalCode;

    /**
     * @var string
     */
    private $formattedAddress;

    public function __construct(array $data)
    {
        if (!empty($data)) {
            $this->createFromArray($data);
        }
    }

    public function createFromArray($data)
    {
        $addressComponents =  $data['results'][0]['address_components'];
        $this->setLongStreetNumber(isset($addressComponents[0]['long_name']) ? $addressComponents[0]['long_name'] : '');
        $this->setShortStreetNumber(isset($addressComponents[0]['short_name']) ? $addressComponents[0]['short_name'] : '');
        $this->setLongRouteName(isset($addressComponents[1]['long_name']) ? $addressComponents[1]['long_name'] : '');
        $this->setShortRouteName(isset($addressComponents[1]['short_name']) ? $addressComponents[1]['short_name'] : '');
        $this->setLongLocalityName(isset($addressComponents[2]['long_name']) ? $addressComponents[2]['long_name'] : '');
        $this->setShortLocalityName(isset($addressComponents[2]['short_name']) ? $addressComponents[2]['short_name'] : '');
        $this->setLongAdministrativeArea2(isset($addressComponents[3]['long_name']) ? $addressComponents[3]['long_name'] : '');
        $this->setShortAdministrativeArea2(isset($addressComponents[3]['short_name']) ? $addressComponents[3]['short_name'] : '');
        $this->setLongAdministrativeArea1(isset($addressComponents[4]['long_name']) ? $addressComponents[4]['long_name'] : '');
        $this->setShortAdministrativeArea1(isset($addressComponents[4]['short_name']) ? $addressComponents[4]['short_name'] : '');
        $this->setLongCountry(isset($addressComponents[5]['long_name']) ? $addressComponents[5]['long_name'] : '');
        $this->setShortCountry(isset($addressComponents[5]['short_name']) ? $addressComponents[5]['short_name'] : '');
        $this->setLongPostalCode(isset($addressComponents[6]['long_name']) ? $addressComponents[6]['long_name'] : '');
        $this->setShortPostalCode(isset($addressComponents[6]['short_name']) ? $addressComponents[6]['short_name'] : '');
        $this->setFormattedAddress(isset($data['results'][0]['formatted_address']) ? $data['results'][0]['formatted_address'] : '');
    }

    /**
     * @return string
     */
    public function getShortStreetNumber(): string
    {
        return $this->shortStreetNumber;
    }

    /**
     * @param string $shortStreetNumber
     */
    public function setShortStreetNumber(string $shortStreetNumber)
    {
        $this->shortStreetNumber = $shortStreetNumber;
    }

    /**
     * @return string
     */
    public function getLongStreetNumber(): string
    {
        return $this->longStreetNumber;
    }

    /**
     * @param string $longStreetNumber
     */
    public function setLongStreetNumber(string $longStreetNumber)
    {
        $this->longStreetNumber = $longStreetNumber;
    }

    /**
     * @return string
     */
    public function getShortRouteName(): string
    {
        return $this->shortRouteName;
    }

    /**
     * @param string $shortRouteName
     */
    public function setShortRouteName(string $shortRouteName)
    {
        $this->shortRouteName = $shortRouteName;
    }

    /**
     * @return string
     */
    public function getLongRouteName(): string
    {
        return $this->longRouteName;
    }

    /**
     * @param string $longRouteName
     */
    public function setLongRouteName(string $longRouteName)
    {
        $this->longRouteName = $longRouteName;
    }

    /**
     * @return string
     */
    public function getShortLocalityName(): string
    {
        return $this->shortLocalityName;
    }

    /**
     * @param string $shortLocalityName
     */
    public function setShortLocalityName(string $shortLocalityName)
    {
        $this->shortLocalityName = $shortLocalityName;
    }

    /**
     * @return string
     */
    public function getLongLocalityName(): string
    {
        return $this->longLocalityName;
    }

    /**
     * @param string $longLocalityName
     */
    public function setLongLocalityName(string $longLocalityName)
    {
        $this->longLocalityName = $longLocalityName;
    }

    /**
     * @return string
     */
    public function getShortAdministrativeArea2(): string
    {
        return $this->shortAdministrativeArea2;
    }

    /**
     * @param string $shortAdministrativeArea2
     */
    public function setShortAdministrativeArea2(string $shortAdministrativeArea2)
    {
        $this->shortAdministrativeArea2 = $shortAdministrativeArea2;
    }

    /**
     * @return string
     */
    public function getLongAdministrativeArea2(): string
    {
        return $this->longAdministrativeArea2;
    }

    /**
     * @param string $longAdministrativeArea2
     */
    public function setLongAdministrativeArea2(string $longAdministrativeArea2)
    {
        $this->longAdministrativeArea2 = $longAdministrativeArea2;
    }

    /**
     * @return string
     */
    public function getShortAdministrativeArea1(): string
    {
        return $this->shortAdministrativeArea1;
    }

    /**
     * @param string $shortAdministrativeArea1
     */
    public function setShortAdministrativeArea1(string $shortAdministrativeArea1)
    {
        $this->shortAdministrativeArea1 = $shortAdministrativeArea1;
    }

    /**
     * @return string
     */
    public function getLongAdministrativeArea1(): string
    {
        return $this->longAdministrativeArea1;
    }

    /**
     * @param string $longAdministrativeArea1
     */
    public function setLongAdministrativeArea1(string $longAdministrativeArea1)
    {
        $this->longAdministrativeArea1 = $longAdministrativeArea1;
    }

    /**
     * @return string
     */
    public function getShortCountry(): string
    {
        return $this->shortCountry;
    }

    /**
     * @param string $shortCountry
     */
    public function setShortCountry(string $shortCountry)
    {
        $this->shortCountry = $shortCountry;
    }

    /**
     * @return string
     */
    public function getLongCountry(): string
    {
        return $this->longCountry;
    }

    /**
     * @param string $longCountry
     */
    public function setLongCountry(string $longCountry)
    {
        $this->longCountry = $longCountry;
    }

    /**
     * @return string
     */
    public function getShortPostalCode(): string
    {
        return $this->shortPostalCode;
    }

    /**
     * @param string $shortPostalCode
     */
    public function setShortPostalCode(string $shortPostalCode)
    {
        $this->shortPostalCode = $shortPostalCode;
    }

    /**
     * @return string
     */
    public function getLongPostalCode(): string
    {
        return $this->longPostalCode;
    }

    /**
     * @param string $longPostalCode
     */
    public function setLongPostalCode(string $longPostalCode)
    {
        $this->longPostalCode = $longPostalCode;
    }

    /**
     * @return string
     */
    public function getFormattedAddress(): string
    {
        return $this->formattedAddress;
    }

    /**
     * @param string $formattedAddress
     */
    public function setFormattedAddress(string $formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;
    }
}