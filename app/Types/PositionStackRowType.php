<?php

namespace App\Types;

class PositionStackRowType
{

    private $latitude = null; //double
    private $longitude = null; //double
    private $label = null; //String
    private $name = null; //String
    private $type = null; //String
    private $number = null; //String
    private $street = null; //String
    private $postal_code = null; //String
    private $confidence = null; //int
    private $region = null; //String
    private $region_code = null; //String
    private $administrative_area = null; //array( undefined )
    private $neighbourhood = null; //String
    private $country = null; //String
    private $country_code = null; //String
    private $map_url = null;

    public function __construct(array $item)
    {
        foreach ($item as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    } //String


}
