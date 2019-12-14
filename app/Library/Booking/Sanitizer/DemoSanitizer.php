<?php

namespace App\Library\Booking\Sanitizer;
/**
 * todo this is just a demo class to understand structure of RequestManagement framework
 * todo delete after you understand the structure
 *
 * Class DemoSanitizer
 * @package App\Library\Booking\Sanitizer
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class DemoSanitizer
{
    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * DemoSanitizer constructor.
     * @param $request array
     */
    public function __construct ($request)
    {
        $this->request = $request;
    }
}