<?php

namespace Tests\Services;

use App\Adapters\IGeolocationDecoder;
use App\Adapters\Implementation\GeolocationDecoder\TestingGeolocationDecoder;
use App\Services\IAddressesService;
use Tests\TestCase;

class AddressesServiceTest extends TestCase
{

    public function test_GeolocationDecoder_dependency_type(): void
    {
        /**
         * @var $geocoder IGeolocationDecoder
         */
        $geocoder = app(IGeolocationDecoder::class);

        $this->assertInstanceOf(TestingGeolocationDecoder::class, $geocoder);
    }

    public function test_service_method_getLatLngForAddressesAndSaveOutput(): void
    {
        /**
         * @var $addressesService IAddressesService
         */
        $addressesService = app(IAddressesService::class);
        $output = $addressesService->getLatLngForAddressesAndSaveOutput();

        $this->assertFileExists(storage_path("csv_files/generated_files/hq_addresses_lat_lng.csv"));
        $this->assertTrue($output);
    }

    public function test_service_method_calculateDistanceAndGenerateSortedFile(): void
    {
        /**
         * @var $addressesService IAddressesService
         */
        $addressesService = app(IAddressesService::class);
        $addresses = $addressesService->calculateDistanceAndGenerateSortedFile();

        $this->assertFileExists(storage_path("csv_files/generated_files/distances.csv"));
        $this->assertIsArray($addresses);
        $this->assertNotEmpty($addresses);
        $this->assertTrue(strpos(implode(" ", $addresses[0]), "KM") !== false);
    }

}
