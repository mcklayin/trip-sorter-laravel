<?php

namespace App\Services\Trip\Transports;

/**
 * Class Bus
 */
class Bus extends AbstractTransport
{
    /** @var string */
    const MESSAGE = 'Take the airport bus';

    /** @var string */
    const MESSAGE_FROM_TO = ' from %s to %s. ';

    /** @var string */
    const MESSAGE_NO_SEAT = 'No seat defined.';

    /**
     * Get a message for a trip
     *
     * @return string
     */
    public function getMessage()
    {
        $message = sprintf(
            static::MESSAGE . static::MESSAGE_FROM_TO,
            $this->departure,
            $this->arrival
        );

        $message .= static::MESSAGE_NO_SEAT;

        return $message;
    }
}
