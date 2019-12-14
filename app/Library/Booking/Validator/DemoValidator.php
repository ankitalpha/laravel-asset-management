<?php

namespace Drivezy\LaravelAssetManager\Library\Booking\Validator;
/**
 * todo this is just a demo class to understand structure of RequestManagement framework
 * todo delete after you understand the structure
 * Class DemoValidator
 * @package App\Library\Booking\Validator
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class DemoValidator
{

    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * DemoValidator constructor.
     * @param $request array
     */
    public function __construct ($request)
    {
        $this->request = $request;
    }
}