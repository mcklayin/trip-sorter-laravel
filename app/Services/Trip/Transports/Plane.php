<?php

namespace App\Services\Trip\Transports;

/**
 * Class Plane
 */
class Plane extends AbstractTransport
{

    /**
     * @var string
     */
    protected $transportationNumber;

    /**
     * @var string
     */
    protected $seat;

    /**
     * @var string
     */
    protected $gate;

    /**
     * @var string
     */
    protected $baggage;

    /**
     * @var string
     */
    const MESSAGE = 'From %s, take flight %s to %s. Gate %s, seat %s.';

    /**
     * @var string
     */
    const MESSAGE_BAGGAGE_TICKET = 'Baggage drop at ticket counter %s.';

    /**
     * @var string
     */
    const MESSAGE_NO_BAGGAGE_TICKET = 'Baggage will we automatically transferred from your last leg.';

    /**
     * Get a message for the trip
     *
     * @return string
     */
    public function getMessage()
    {
        $message = sprintf(
            static::MESSAGE,
            $this->departure,
            $this->transportationNumber,
            $this->arrival,
            $this->gate,
            $this->seat
        );

        // Add Baggage to message
        if (!empty($this->baggage)) {
            $message .= sprintf(
                PHP_EOL . '   ' . static::MESSAGE_BAGGAGE_TICKET,
                $this->baggage
            );

            return $message;
        }

        // No baggage baggage
        $message .= PHP_EOL . '   ' . static::MESSAGE_NO_BAGGAGE_TICKET;

        return $message;
    }
}
