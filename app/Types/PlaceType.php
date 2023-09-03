<?php

namespace App\Types;

class PlaceType
{

    private ?string $placeName = null;
    private ?string $placeAddress = null;
    private ?string $placeLatitude = null;
    private ?string $placeLongitude = null;
    private ?float $distance = null;

    public function __construct(array $item)
    {
        foreach ($item as $key => $value) {
            $this->{$key} = trim($value);
        }
    }

    /**
     * @param string|null $placeName
     */
    public function setPlaceName(?string $placeName): self
    {
        $this->placeName = $placeName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceName(): ?string
    {
        return $this->placeName;
    }

    /**
     * @param string|null $placeAddress
     */
    public function setPlaceAddress(?string $placeAddress): self
    {
        $this->placeAddress = $placeAddress;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceAddress(): ?string
    {
        return $this->placeAddress;
    }

    /**
     * @param string|null $placeLatitude
     */
    public function setPlaceLatitude(?string $placeLatitude): self
    {
        $this->placeLatitude = $placeLatitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceLatitude(): ?string
    {
        return $this->placeLatitude;
    }

    /**
     * @param string|null $placeLongitude
     */
    public function setPlaceLongitude(?string $placeLongitude): self
    {
        $this->placeLongitude = $placeLongitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceLongitude(): ?string
    {
        return $this->placeLongitude;
    }

    /**
     * @param float|null $distance
     */
    public function setDistance(?float $distance): self
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getDistance(): ?float
    {
        return $this->distance;
    }


}
