<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;
/**
 * Class BookingCreation
 * @package Drivezy\LaravelAssetManager\Library\Booking
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 * TODO need to modify
 */
class BookingCreation
{

    /**
     * BookingCreation constructor.
     * @param $request
     */
    public function __construct ($request) {
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
    public function createBooking () {
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
    public function bookCar () {
        BookingUtility::dropUserLock();

        $this->request->booking = $this->createBookingObject();
    }


    /**
     * Prepares initial booking parameters that are available.
     * And create The Booking record
     */
    private function createBookingObject () {
        $booking = new Booking();

        $booking->token = CustomBooking::getBookingReference();

        $booking->user_id = $this->request->user->id;
        $booking->asset_category_id = $this->request->car->id;

        $booking->start_time = $this->request->start_time;
        $booking->end_time = $this->request->end_time;

        $booking->latitude = $this->request->latitude;
        $booking->longitude = $this->request->longitude;
        $booking->location_name = isset($this->request->location_name) ? $this->request->location_name : null;

        $booking->drop_latitude = $this->request->drop_latitude;
        $booking->drop_longitude = $this->request->drop_longitude;
        $booking->drop_location_name = isset($this->request->drop_location_name) ? $this->request->drop_location_name : null;

        $booking->outstations = isset($this->request->outstations) ? $this->request->outstations : null;

        $booking->booking_type = $this->request->type;
        $booking->booking_source = $this->request->src;

        $booking->is_bike = $this->request->is_bike;
        $booking->coupon_id = isset($this->request->coupon) ? $this->request->coupon->id : null;

        $booking->fuel_package = $this->request->fuel_package;
        $booking->free_km = isset($this->request->free_km) ? $this->request->free_km : null;

        $booking->drop_venue_id = $this->request->drop_venue_id;
        $booking->pickup_venue_id = $this->request->pickup_venue_id;

        $booking->billing_car_id = $this->request->car->id;
        $booking->vehicle_id = $this->request->vehicle_id;
        $booking->requested_vehicle_id = $this->request->vehicle_id;
        $booking->vehicle_detail_id = $this->request->vehicle_detail_id;
        $booking->tentative_amount = $this->request->tentative_amount;

        $booking->save();

        return $booking;
    }

    /**
     * Fetch response
     */
    private function getResponse () {
        foreach ( $this->responseManager as $responseManager ) {
            $this->request = ( new $responseManager($this->request) )->response();
        }
    }
}