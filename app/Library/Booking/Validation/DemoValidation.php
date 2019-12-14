<?php

namespace App\Library\Booking\Validation;
/**
 * todo this is just a demo class to understand structure of RequestManagement framework
 * todo delete after you understand the structure
 * Class DemoValidation
 * @package App\Library\Booking\Validation
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class DemoValidation
{

    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * DemoValidation constructor.
     * @param $request array
     */
    public function __construct ($request)
    {
        $this->request = $request;
    }
}