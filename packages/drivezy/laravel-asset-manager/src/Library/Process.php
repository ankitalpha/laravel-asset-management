<?php

namespace Drivezy\LaravelAssetManager\Library;
/**
 * Class Process
 * @package App\Library
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class Process
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
     * @return array|null
     * @internal  Package make it mandatory to declare process method in your class
     * Generic Processing method
     */
    public function procedure ()
    {
        $this->process();

        return $this->request;
    }
}