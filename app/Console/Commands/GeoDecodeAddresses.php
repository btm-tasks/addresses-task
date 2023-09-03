<?php

namespace App\Console\Commands;

use App\Services\IAddressesService;
use Illuminate\Console\Command;

class GeoDecodeAddresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:geo-decode-addresses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * @var $addressesService IAddressesService
         */
        $addressesService = app(IAddressesService::class);
        $addressesService->getLatLngForAddressesAndSaveOutput();
    }
}
