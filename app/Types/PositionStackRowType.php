<?php

namespace App\Types;

class PositionStackRowType
{

    private ?float $latitude = null;
    private ?float $longitude = null;
    private ?string $label = null;
    private ?string $name = null;
    private ?string $type = null;
    private ?string $number = null;
    private ?string $street = null;
    private ?string $postal_code = null;
    private ?int $confidence = null;
    private ?string $region = null;
    private ?string $region_code = null;
    private ?array $administrative_area = null;
    private ?string $neighbourhood = null;
    private ?string $country = null;
    private ?string $country_code = null;
    private ?string $map_url = null;

    public function __construct(array $item)
    {
        foreach ($item as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    /**
     * @return int|null
     */
    public function getConfidence(): ?int
    {
        return $this->confidence;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string|null
     */
    public function getRegionCode(): ?string
    {
        return $this->region_code;
    }

    /**
     * @return array|null
     */
    public function getAdministrativeArea(): ?array
    {
        return $this->administrative_area;
    }

    /**
     * @return string|null
     */
    public function getNeighbourhood(): ?string
    {
        return $this->neighbourhood;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    /**
     * @return string|null
     */
    public function getMapUrl(): ?string
    {
        return $this->map_url;
    }



}
