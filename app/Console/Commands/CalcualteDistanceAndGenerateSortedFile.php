<?php

namespace App\Console\Commands;

use App\Services\IAddressesService;
use Illuminate\Console\Command;

class CalcualteDistanceAndGenerateSortedFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calcualte-distance-and-generate-sorted-file';

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
        $addresses = $addressesService->calculateDistanceAndGenerateSortedFile();

        foreach ($addresses as $address) {
            $this->info(implode(", ", $address));
        }
    }
}
