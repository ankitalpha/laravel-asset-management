<?php

namespace Drivezy\LaravelAssetManager\Library\Booking\BookingType;
/**
 * Class MaintenanceBooking
 * @package Drivezy\LaravelAssetManager\Library\Booking\BookingType
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class RegularBooking
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
    public $sanitizers = [];

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