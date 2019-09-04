<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;
use Illuminate\Support\Str;

/**
 * Class BookingUtility
 * @package App\Library\Booking
 *
 * @see  task on JIRA
 */
class BookingUtility
{

    public static function toCamelCase ()
    {
        return Str::camel();
    }

}