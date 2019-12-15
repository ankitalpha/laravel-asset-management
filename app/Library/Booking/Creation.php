<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;

use Drivezy\LaravelAssetManager\Models\AssetBooking;

/**
 * Class Creation
 * @package Drivezy\LaravelAssetManager\Library\Booking
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class Creation
{
    /**
     * Creation constructor.
     * @param $request
     */
    public function __construct ($request)
    {
        $bookingObject = ( new Management($request) )->request;

        $this->preValidations = $bookingObject->preValidations;
        $this->sanitisers = $bookingObject->sanitisers;
        $this->postValidations = $bookingObject->postValidations;

        $this->process = $bookingObject->process;
        $this->responseManager = $bookingObject->responseManager;

        //todo create it accordingly
        array_push($this->preValidations, BookingCreationRequestValidation::class);

        $this->request = $bookingObject->request;
    }

    /**
     * Creates booking
     * @return array
     * @throws \Exception
     */
    public function createBooking ()
    {
        if ( !$this->preValidation() )
            return $this->request = failure_message($this->request);

        $this->sanitiser();

        if ( !$this->postValidation() )
            return $this->request = failure_message($this->request);

        $this->process();

        $this->bookCar();

        $this->getResponse();

        return success_message($this->request);
    }

    /**
     * This method will the book car based on booking type
     */
    public function bookCar ()
    {
        Utility::dropUserLock();
        $this->createBookingObject();
    }


    /**
     * Prepares initial booking parameters that are available.
     * And create The Booking record
     */
    private function createBookingObject ()
    {
        $this->request->booking = new AssetBooking();

        $columns = Utility::getColumns('dz_asset_bookings', ['id']);

        foreach ( $columns as $column ) {
            $this->request->booking->$column = $this->request->$column ?? null;
        }

        $this->request->booking->reference_number = Utility::generateReferenceNumber();
        $this->request->booking->save();
    }

    /**
     * Fetch response
     */
    private function getResponse ()
    {
        foreach ( $this->responseManager as $responseManager ) {
            $this->request = ( new $responseManager($this->request) )->response();
        }
    }
}