<?php

namespace Drivezy\LaravelAssetManager\Library;
/**
 * Class Validator
 * @package App\Library
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class Validator
{
    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * Validator constructor.
     * @param $request array
     */
    public function __construct ($request)
    {
        $this->request = $request;
    }

    public function validation ()
    {
        if ( !$this->validate() ) return false;

        return $this->request;
    }
}