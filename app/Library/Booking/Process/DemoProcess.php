<?php

namespace Drivezy\LaravelAssetManager\Library\Booking\Process;

use Drivezy\LaravelAssetManager\Library\Process;
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
class DemoProcess extends Process
{
    /**
     * Process request
     * @return array|null
     */
    public function process ()
    {
        return $this->request;
    }
}