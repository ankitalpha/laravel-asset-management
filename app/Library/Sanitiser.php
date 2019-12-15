<?php

namespace Drivezy\LaravelAssetManager\Library;
/**
 * Class Sanitiser
 * @package App\Library
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class Sanitiser
{
    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * DemoSanitiser constructor.
     * @param $request array
     */
    public function __construct ($request)
    {
        $this->request = $request;
    }

    /**
     * @return array|null
     * @internal  Package make it mandatory to declare sanitise method in your class
     * Generic Sanitising method
     */
    public function sanitser ()
    {
        $this->sanitse();

        return $this->request;
    }
}