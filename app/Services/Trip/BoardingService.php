<?php

namespace App\Services\Trip;

/**
 * Class BoardingService
 *
 */
class BoardingService
{
    /**
     * Boardings
     *
     * @var array
     */
    protected $boardings = [];

    /**
     * BoardingService constructor.
     * @param array $boardings
     */
    function __construct(array $boardings)
    {
        $this->boardings = $boardings;
    }

    /**
     * Sort boardings
     * This function sorts the boardings in order
     */
    public function build()
    {
        // Get first and last trip
        $this->buildFirstLastBoarding();

        for ($i = 0, $size = count($this->boardings) - 1 ; $i < $size ; $i++) {
            // Lookup for the arrival city and the departure city
            foreach ($this->boardings as $index => $trip) {
                if (strcasecmp($this->boardings[$i]['Arrival'], $trip['Departure']) == 0) {
                    $nextIndex = $i + 1;
                    $tmp = $this->boardings[$nextIndex];
                    $this->boardings[$nextIndex] = $trip;
                    $this->boardings[$index] = $tmp;
                }
            }
        }
    }

    /**
     * Build start & end boardings
     */
    private function buildFirstLastBoarding()
    {
        $hasPreviousBoarding = false;
        $isLastBoarding = true;

        for ($i = 0, $size = count($this->boardings); $i < $size ; $i++) {
            // Lookup for the arrival city and the departure city
            foreach ($this->boardings as $trip) {
                // If current trip departure is another's trip arrival, so we have a previous trip
                if (strcasecmp($this->boardings[$i]['Departure'], $trip['Arrival']) == 0) {
                    $hasPreviousBoarding = true;
                } elseif (strcasecmp($this->boardings[$i]['Arrival'], $trip['Departure']) == 0) {
                    // If current trip's arrival is another trip departure, then it is not the last trip
                    $isLastBoarding = false;
                }
            }

            if (!$hasPreviousBoarding) {
                // Its first trip, so should be a first element
                array_unshift($this->boardings, $this->boardings[$i]);
                unset($this->boardings[$i]);
            } elseif ($isLastBoarding) {
                // Lat element pushed to the end
                array_push($this->boardings, $this->boardings[$i]);
                unset($this->boardings[$i]);
            }
        }

        // We regenerate indexes
        $this->boardings = array_merge($this->boardings);
    }

    /**
     * Get boardings
     *
     * @return array
     */
    public function getBoardings(): array
    {
        return $this->boardings;
    }
}
