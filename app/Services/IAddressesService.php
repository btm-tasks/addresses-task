<?php

namespace App\Services;

interface IAddressesService
{

    public function getLatLngForAddressesAndSaveOutput(): bool;

    public function calculateDistanceAndGenerateSortedFile(): array;

}
