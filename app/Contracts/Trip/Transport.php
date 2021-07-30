<?php

namespace App\Contracts\Trip;

/**
 * Interface Transport
 *
 */
interface Transport
{

    /**
     * Return a message
     *
     * @return string
     */
    public function getMessage();

}
