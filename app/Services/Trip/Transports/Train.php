<?php

namespace App\Services\Trip\Transports;

/**
 * Class Train
 */
class Train extends AbstractTransport
{

    /**
     * @var string
     */
    protected $transportationNumber;

    /**
     * @var string
     */
    protected $seat;

    /** @var string  */
    const MESSAGE = 'Take train %s';

    /** @var string  */
    const MESSAGE_FROM_TO = ' from %s to %s. ';

    /** @var string  */
    const MESSAGE_SEAT = 'Sit in seat %s.';

    /**
     * Get a message for the trip
     *
     * @return string
     */
    public function getMessage()
    {
        // Add Transportation number to the message
        $message = sprintf(static::MESSAGE, $this->transportationNumber);

        // Add (from => to) to the message
        $message = sprintf(
            $message . static::MESSAGE_FROM_TO,
            $this->departure,
            $this->arrival
        );

        // Add Seat number to the message
        $message = sprintf($message . static::MESSAGE_SEAT, $this->seat);

        return $message;
    }
}
