<?php

namespace App\Services\Trip;

use App\Services\Trip\Transports\Bus;
use App\Services\Trip\Transports\Plane;
use App\Services\Trip\Transports\Train;

class TripService
{
    /**
     * Boardings
     *
     * @var array
     */
    protected $boardings = [];

    /**
     * Sorted boardings
     *
     * @var array
     */
    protected $builtBoardings = [];

    /**
     * Default set of $transports
     *
     * @var array
     */
    protected static $transports = [
        'Train' => Train::class,
        'Bus' => Bus::class,
        'Plane' => Plane::class,
    ];

    function __construct($boardings)
    {
        $this->boardings = $boardings;
    }

    public function addBoarding($boarding)
    {
        $this->boardings[] = $boarding;
    }

    /**
     * Build trip with sorted boardings
     *
     * @throws \Exception
     */
    public function build()
    {
        $this->validate();

        $boardingService = new BoardingService($this->boardings);
        $boardingService->build();
        $this->builtBoardings = $boardingService->getBoardings();
    }

    /**
     * @throws \Exception
     */
    private function validate()
    {
        foreach ($this->boardings as $boarding) {
            $type = $boarding['Transportation'];

            if (!isset(static::$transports[$type])) {
                throw new \Exception(
                    sprintf(
                        'Unsupported transport : %s',
                        $type
                    )
                );
            }
        }
    }

    /**
     * Get list of transports
     *
     * @return array
     */
    private function getTransports(): array
    {
        $transportsList = [];

        if (count($this->builtBoardings) == 0) {
            return $transportsList;
        }

        foreach ($this->builtBoardings as $boarding) {
            $type = $boarding['Transportation'];
            $transportsList[] = new static::$transports[$type]($boarding);
        }

        return $transportsList;

    }

    /**
     * Display Trip
     *
     * @throws \Exception
     */
    public function display()
    {
        foreach ($this->getRoutes() as $tripBoarding) {
            echo $tripBoarding . PHP_EOL . PHP_EOL;
        }
    }

    /**
     * Get formatted Trip results
     *
     * @throws \Exception
     */
    public function getRoutes(): array
    {
        $results = [];
        $transports = $this->getTransports();

        foreach ($transports as $index => $transport) {
            $results[] = ($index + 1) . ". " . $transport->getMessage();

            if ($index == (count($this->boardings) - 1)) {
                $results[] = ($index + 2) . ". " . $transport::MESSAGE_FINAL_DESTINATION;
            }
        }

        return $results;
    }

}
