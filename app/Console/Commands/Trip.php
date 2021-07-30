<?php

namespace App\Console\Commands;

use App\Services\Trip\TripService;
use Illuminate\Console\Command;

class Trip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trip command will build sorted trip with dummy data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dummyBoradings = [
            [
                "Departure" => "Stockholm",
                "Arrival" => "New York",
                "Transportation" => "Plane",
                "TransportationNumber" => "SK22",
                "Seat" => "7B",
                "Gate" => "22"
            ],
            [
                "Departure" => "Madrid",
                "Arrival" => "Barcelona",
                "Transportation" => "Train",
                "TransportationNumber" => "78A",
                "Seat" => "45B"
            ],
            [
                "Departure" => "Gerona Airport",
                "Arrival" => "Stockholm",
                "Transportation" => "Plane",
                "TransportationNumber" => "SK455",
                "Seat" => "3A",
                "Gate" => "45B",
                "Baggage" => "334"
            ],
            [
                "Departure" => "Barcelona",
                "Arrival" => "Gerona Airport",
                "Transportation" => "Bus"
            ],
        ];


        $tripService = new TripService($dummyBoradings);

        try {
            $tripService->build();
            $tripRoutes = $tripService->getRoutes();

            $this->newLine(1);

            foreach ($tripRoutes as $boarding) {
                $this->info($boarding);
                $this->newLine(2);
            }

        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }


        return 0;
    }
}
