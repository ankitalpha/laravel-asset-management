<?php

namespace Drivezy\LaravelAssetManager;

/**
 * Class BaseBooking
 * @package Drivezy\LaravelAssetManager
 *
 */
class RequestKernel
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
    protected $listen = true;

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

        $this->sanitizer();

        if ( !$this->postValidation() )
            return $this->request = failure_message($this->request);

        $this->process();

        return success_message($this->request->response);
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
    public function sanitizer ()
    {
        foreach ( $this->sanitizers as $sanitizer ) {
            $this->request = ( new $sanitizer($this->request) )->sanitize();

            if(!$this->listen) break;
        }
    }

    /**
     * Post validation of request
     * @return bool|mixed
     */
    public function postValidation ()
    {
        foreach ( $this->postValidations as $validation ) {
            $this->request = ( new $validation($this->request) )->validate();

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
            $this->request = ( new $process($this->request) )->process();

            if(!$this->listen) break;
        }
    }
}