<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;

use Drivezy\LaravelAssetManager\Library\Booking\BookingType\DemoBooking;

/**
 * Class Management
 * @package App\Library\Booking
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class Management
{
    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * Management constructor.
     * @param $request array
     */
    public function __construct ($request)
    {
        $this->request = $request;
        $this->request = $this->classInstance();
    }

    /**
     * Return class instance of the type of the booking request is made on.
     * @return DemoBooking
     */
    public function classInstance ()
    {
        switch ( $this->request->type ) {
            case 'Demo Booking' :
            default :
                return ( new DemoBooking($this->request) );
        }
    }
}