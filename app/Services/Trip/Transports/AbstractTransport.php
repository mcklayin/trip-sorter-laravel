<?php

namespace App\Services\Trip\Transports;

use App\Contracts\Trip\Transport;

/**
 * Class AbstractTransport
 *
 */
abstract class AbstractTransport implements Transport
{

    /**
     * @var string
     */
    protected $departure;

    /**
     * @var string
     */
    protected $arrival;

    /**
     *
     */
    const MESSAGE_FINAL_DESTINATION = 'You have been arrived at your final destination.';

    /**
     * @param array $trip
     */
    public function __construct(array $trip)
    {
        foreach ($trip as $key => $value) {
            $property = lcfirst($key);

            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

}
