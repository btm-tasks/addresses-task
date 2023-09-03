<?php

namespace App\Adapters\Implementation\GeolocationDecoder;


use App\Adapters\IGeolocationDecoder;
use App\Exceptions\InvalidPositionStackResponse;
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
                throw new InvalidPositionStackResponse(
                    json_encode([
                        "address" => $address,
                        "message" => "invalid response",
                        "response" => $res,
                    ])
                );
            }

            $res = new PositionStackRowType($res['data'][0]);

            $geolocationType
                ->setLatitude($res->getLatitude())
                ->setLongitude($res->getLongitude());
        } catch (\Throwable $exception) {
            //in real life scenarios, I send the entire error object to slack
            Log::error($exception->getMessage());
        }

        return $geolocationType;
    }

}
