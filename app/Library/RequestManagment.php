<?php

namespace Drivezy\LaravelAssetManager\Library;

/**
 * Class BaseBooking
 * @package Drivezy\LaravelAssetManager
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class RequestManagment
{
    /**
     * Request variables
     * @var array
     */
    public $request = null;

    /**
     * Flag that will break process and sanitizer
     * @var bool
     */
    protected static $listen = true;

    /**
     * Error code for front end to understand the next possible action
     * @var int|null
     */
    public static $errorCode = null;

    /**
     * BaseBooking constructor.
     * @param array $request
     */
    public function __construct ($request)
    {
        $this->initialization($request);
    }

    /**
     * Initialization of request object
     * @param $request
     */
    private function initialization ($request)
    {
        foreach ( $request as $key => $value ) {
            $this->request[ $key ] = $value;
        }

        $this->request = (object) $this->request;
    }

    /**
     * Execute request.
     * @return array|mixed
     */
    public function execute ()
    {
        if ( !$this->preValidation() )
            return $this->request = failure_message($this->request);

        $this->sanitiser();

        if ( !$this->postValidation() )
            return $this->request = failure_message($this->request);

        $this->process();

        if ( self::$listen ) {
            return success_message($this->request ? : []);
        } else
            return failure_message('Something went wrong', self::$errorCode);
    }

    /**
     * Pre Validate request.
     * @return bool|mixed
     */
    public function preValidation ()
    {
        foreach ( $this->preValidations as $validation ) {
            $this->request = ( new $validation($this->request) )->validate();

            if ( !$this->request ) return false;
        }

        return true;
    }

    /**
     * Sanitize request
     * @return mixed|void
     */
    public function sanitiser ()
    {
        foreach ( $this->sanitisers as $sanitiser ) {
            $this->request = ( new $sanitiser($this->request) )->sanitiser();

            if ( !self::$listen ) break;
        }
    }

    /**
     * Post validation of request
     * @return bool|mixed
     */
    public function postValidation ()
    {
        foreach ( $this->postValidations as $validation ) {
            $this->request = ( new $validation($this->request) )->validation();

            if ( !$this->request ) return false;
        }

        return true;
    }

    /**
     * Process request
     */
    public function process ()
    {
        foreach ( $this->process as $process ) {
            $this->request = ( new $process($this->request) )->procedure();

            if ( !self::$listen ) break;
        }
    }
}