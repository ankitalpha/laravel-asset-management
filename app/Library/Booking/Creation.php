<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;

use Drivezy\LaravelAssetManager\Models\AssetBooking;

/**
 * Class Creation
 * @package Drivezy\LaravelAssetManager\Library\Booking
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 * TODO need to modify
 */
class Creation
{

    /**
     * Creation constructor.
     * @param $request
     */
    public function __construct ($request)
    {
        $bookingObject = ( new BookingManagement($request) )->request;

        $this->preValidations = $bookingObject->preValidations;
        $this->sanitizers = $bookingObject->sanitizers;
        $this->postValidations = $bookingObject->postValidations;

        $this->process = $bookingObject->process;
        $this->responseManager = $bookingObject->responseManager;

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

        $this->sanitizer();

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

        $this->request->booking = $this->createBookingObject();
    }


    /**
     * Prepares initial booking parameters that are available.
     * And create The Booking record
     */
    private function createBookingObject ()
    {
        $booking = new AssetBooking();

        //todo add logic for token creation
        $booking->token = CustomBooking::getBookingReference();

        $booking->user_id = $this->request->user->id;
        $booking->asset_category_id = $this->request->car->id;

        $booking->start_time = $this->request->start_time;
        $booking->end_time = $this->request->end_time;

        $booking->type_id = $this->request->type_id;

        $booking->coupon_id = isset($this->request->coupon) ? $this->request->coupon->id : null;

        $booking->drop_address_id = $this->request->drop_address_id;
        $booking->pickup_address_id = $this->request->pickup_address_id;

        $booking->asset_detail_id = $this->request->asset_detail_id;
        $booking->tentative_amount = $this->request->tentative_amount;

        $booking->save();

        return $booking;
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