<?php

namespace App\Library\Booking;
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
    }
}