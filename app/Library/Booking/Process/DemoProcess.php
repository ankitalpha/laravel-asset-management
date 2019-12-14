<?php

namespace App\Library\Booking\Process;

use JRApp\Libraries\Booking\CustomBooking;

/**
 * todo this is just a demo class to understand structure of RequestManagement framework
 * todo delete after you understand the structure
 *
 * Class DemoProcess
 * @package App\Library\Booking\Process
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class DemoProcess
{
    /**
     * The request variable.
     * var array|null
     */
    protected $request = null;

    /**
     * CreateCancellationRecord constructor.
     * @param $request array
     */
    public function __construct ($request)
    {
        $this->request = $request;
    }

    /**
     * Process request
     * @return array|null
     */
    public function process ()
    {
        return $this->request;
    }
}