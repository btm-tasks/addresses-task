<?php

namespace App\Services\Implementation;

use App\Adapters\IGeolocationDecoder;
use App\Helpers\CsvHelper;
use App\Services\IAddressesService;
use App\Types\PlaceType;
use Mockery\Exception;

class AddressesService implements IAddressesService
{

    public function getLatLngForAddressesAndSaveOutput(): bool
    {
        /**
         * @var $geocoder IGeolocationDecoder
         */
        $geocoder = app(IGeolocationDecoder::class);

        //get all addresses, and decode all addresses
        /**
         * @var $addresses PlaceType[]
         */
        $addresses = CsvHelper::csvConverted(storage_path('csv_files/hq_addresses.csv'), '-', PlaceType::class);

        foreach ($addresses as $address){
            $geolocationType = $geocoder->geocode($address->getPlaceAddress());
            $address
                ->setPlaceLatitude($geolocationType->getLatitude())
                ->setPlaceLongitude($geolocationType->getLongitude())
            ;
        }

        //save the decoded address to another file
        $headers = ["placeName", "placeAddress", "placeLatitude", "placeLongitude"];
        $addresses = array_map(function ($address) {
            /**
             * @var $address PlaceType
             */
            return [
                $address->getPlaceName(),
                $address->getPlaceAddress(),
                $address->getPlaceLatitude(),
                $address->getPlaceLongitude(),
            ];
        }, $addresses);

        CsvHelper::arrayToCsv(storage_path('csv_files/generated_files/hq_addresses_lat_lng.csv'), $addresses, $headers);

        return true;
    }

    private function getAddressFromArray(array $addresses, string $placeName): PlaceType
    {
        $place = array_filter($addresses, function($address) use($placeName){
            /**
             * @var $address PlaceType
             */
            if ($placeName == $address->getPlaceName()){
                return $address;
            }
        });

        if(!is_array($place) || count($place) == 0){
            throw new Exception("object is not found");
        }

        return $place[0];
    }

    /**
     * @return PlaceType[]
     */
    private function excludeAddressFromArray(array $addresses, string $placeName): array
    {
        $places = array_filter($addresses, function($address) use($placeName){
            /**
             * @var $address PlaceType
             */
            if ($placeName != $address->getPlaceName()){
                return $address;
            }
        });

        return $places;
    }

    private function getDistanceBetweenTwoPoints($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return round(($angle * $earthRadius)/1000,2);
    }

    /**
     * @param PlaceType[] $addresses
     * @return array
     */
    private function printedArr(array $addresses): array
    {
        $printArr = [];
        $counter = 1;
        foreach ($addresses as $key=>$address){
            if ($address->getDistance() == -1){
                //exclude wrong results
                continue;
            }
            $printArr[] = [
                $counter++,
                $address->getDistance()." KM",
                $address->getPlaceName(),
                $address->getPlaceAddress()
            ];
        }

        return $printArr;
    }

    public function calculateDistanceAndGenerateSortedFile(): array {
        /**
         * @var $addresses PlaceType[]
         */
        $addresses = CsvHelper::csvConverted(storage_path('csv_files/generated_files/hq_addresses_lat_lng.csv'), '-', PlaceType::class);
        $AdchieveHQPlace = $this->getAddressFromArray($addresses, "Adchieve HQ");
        $addresses       = $this->excludeAddressFromArray($addresses, "Adchieve HQ");

        foreach ($addresses as $address)
        {
            $distance = -1;
            if (!empty($address->getPlaceLatitude()) && !empty($address->getPlaceLongitude())){
                $distance = $this->getDistanceBetweenTwoPoints(
                    $AdchieveHQPlace->getPlaceLatitude(),
                    $AdchieveHQPlace->getPlaceLongitude(),
                    $address->getPlaceLatitude(),
                    $address->getPlaceLongitude(),
                );
            }

            $address->setDistance($distance);
        }

        usort($addresses, function($a, $b) {return strcmp($a->getDistance(), $b->getDistance());});
        $addresses = $this->printedArr($addresses);

        $headers = ["Sortnumber", "Distance", "Name", "Address"];
        CsvHelper::arrayToCsv(storage_path('csv_files/generated_files/distances.csv'), $addresses, $headers);

        return $addresses;
    }

}
