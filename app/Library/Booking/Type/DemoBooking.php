<?php

namespace Drivezy\LaravelAssetManager\Library\Booking\BookingType;

/**
 * todo this is just a demo class to understand structure of RequestManagement framework
 * todo delete after you understand the structure
 *
 * Class DemoBooking
 * @package Drivezy\LaravelAssetManager\Library\Booking\Type
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class DemoBooking
{
    /**
     * Pre validation request
     *
     * @var array
     */
    public $preValidations = [];

    /**
     * Request sanitizer
     * @var array
     */
    public $sanitisers = [];

    /**
     * Post validation request.
     *
     * @var array
     */
    public $postValidations = [];

    /**
     * Array of classes to process request and generate return Response.
     * @var array
     */
    public $process = [];

    /**
     * This method is processed after successful booking creation
     * Array of classes to generate return Response.
     * @var array
     */
    public $responseManager = [];
}