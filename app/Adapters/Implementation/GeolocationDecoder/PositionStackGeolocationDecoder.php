<?php

namespace App\Adapters\Implementation\GeolocationDecoder;


use App\Adapters\IGeolocationDecoder;
use App\Exceptions\CustomExceptionHandler;
use App\Types\GeolocationType;
use App\Types\PositionStackRowType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PositionStackGeolocationDecoder implements IGeolocationDecoder
{

    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env("POSITIONSTACK_KEY");
    }

    public function geocode(string $address): GeolocationType
    {
        $geolocationType = new GeolocationType();

        try {
            $res = Http::get('http://api.positionstack.com/v1/forward', [
                'access_key' => $this->apiKey,
                'query' => $address
            ]);

            $res = $res->getBody()->getContents();
            $res = json_decode($res, true);

            if (!isset($res['data']) || !isset($res['data'][0])) {
                Log::error(
                    "invalid data from position slack - ".
                    json_encode([
                        "address" => $address,
                        "message" => "invalid response",
                        "response" => $res,
                    ])
                );

                $geolocationType
                ->setLatitude(0)
                ->setLongitude(0);

                return $geolocationType;
            }

            $res = new PositionStackRowType($res['data'][0]);

            $geolocationType
                ->setLatitude($res->getLatitude())
                ->setLongitude($res->getLongitude());
        } catch (\Throwable $exception) {
            throw new CustomExceptionHandler("Error while using position slack ".$exception->getMessage(), 506, $exception);
        }

        return $geolocationType;
    }

}
